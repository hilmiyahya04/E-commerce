<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\orders;
use App\Models\Product;
use App\Models\User;

class BuildSimilarityTable extends Page
{
    protected string $view = 'filament.pages.BuildSimilarityTable';

    protected static ?string $navigationLabel = 'Build Similarity';

    protected static ?string $modelLabel = 'Build Similarity';

    protected static ?string $pluralModelLabel = 'Build Similarity';

    public $matrix = [];
    public $similarities = [];
    public $users = [];
    public $products = [];
    public $predictions = [];
    public $recommendations = [];
    public $mae = 0;          
    public $maeDetails = []; 

    // Threshold similarity minimum agar dianggap relevan
    private const SIMILARITY_THRESHOLD = -1;

    public function mount()
    {
        $this->products = Product::all();
        $this->matrix = $this->buildMatrix();
        $this->users = User::whereIn('id', array_keys($this->matrix))->get();
        $this->similarities = $this->buildSimilarityTable();
        $this->predictions = $this->getPredictions();
        $this->recommendations = $this->getRecommendations();
        $this->maeDetails = $this->getMAEDetails();       
        $this->mae = count($this->maeDetails) > 0            
        ? round(array_sum(array_column($this->maeDetails, 'error')) / count($this->maeDetails), 4)
        : 0;
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public static function getNavigationGroup(): string
    {
        return 'Collaborative Filtering';
    }

    public static function getNavigationSort(): int
    {
        return 2;
    }

    // Bangun matriks rating
    private function buildMatrix()
    {
        $matrix = [];

        $orders = orders::where('orderStatus', 'completed')
            ->with('items.product')
            ->get();

        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                if (!$item->product) continue;
                $userId = $order->userId;
                $productCode = $item->product->productCode;
                if (!isset($matrix[$userId][$productCode])) {
                    $matrix[$userId][$productCode] = 0;
                }
                $matrix[$userId][$productCode] += $item->qty;
            }
        }

        foreach ($matrix as $userId => $products) {
            foreach ($products as $productCode => $qty) {
                if ($qty >= 3) $matrix[$userId][$productCode] = 5;
                elseif ($qty == 2) $matrix[$userId][$productCode] = 4;
                else $matrix[$userId][$productCode] = 3;
            }
        }

        return $matrix;
    }

    private function getUserAverageRating($userId)
    {
        return array_sum($this->matrix[$userId]) / count($this->matrix[$userId]);
    }
    
    private function cosineSimilarity(array $ratingsA, array $ratingsB): float
    {
        $commonUsers = array_intersect(
            array_keys($ratingsA),  
            array_keys($ratingsB)
        );

        if (count($commonUsers) < 2) {
            return 0;
        }

        $numerator = 0;
        $denominatorA = 0;
        $denominatorB = 0;

        foreach ($commonUsers as $userId) {

            $userAvg = $this->getUserAverageRating($userId);

            $adjustedA = $ratingsA[$userId] - $userAvg;
            $adjustedB = $ratingsB[$userId] - $userAvg;

            $numerator += $adjustedA * $adjustedB;

            $denominatorA += pow($adjustedA, 2);
            $denominatorB += pow($adjustedB, 2);
        }

        $denominator = sqrt($denominatorA) * sqrt($denominatorB);

        return $denominator > 0
            ? round($numerator / $denominator, 4)
            : 0;
    }

    // Bangun tabel similarity antar semua produk (Item-Based CF)
    private function buildSimilarityTable()
    {
        $similarities = [];
        $productCodes = $this->products->pluck('productCode')->toArray();

        foreach ($productCodes as $productA) {
            foreach ($productCodes as $productB) {
                if ($productA == $productB) {
                    $similarities[$productA][$productB] = 1.0;
                } else {
                    $ratingsA = [];
                    $ratingsB = [];

                    foreach ($this->matrix as $userId => $products) {
                        if (isset($products[$productA])) {
                            $ratingsA[$userId] = $products[$productA];
                        }
                        if (isset($products[$productB])) {
                            $ratingsB[$userId] = $products[$productB];
                        }
                    }

                    $similarities[$productA][$productB] = $this->cosineSimilarity($ratingsA, $ratingsB);
                }
            }
        }

        return $similarities;
    }

    // Hitung prediksi rating
    private function getPredictions()
    {
        $predictions = [];
        $productCodes = $this->products->pluck('productCode')->toArray();

        foreach ($this->matrix as $userId => $ratedProducts) {

            foreach ($productCodes as $productCode) {

                if (isset($ratedProducts[$productCode])) {
                    continue;
                }

                $numerator = 0;
                $denominator = 0;

                foreach ($ratedProducts as $ratedCode => $rating) {

                    $sim = $this->similarities[$productCode][$ratedCode] ?? 0;

                    // gunakan threshold similarity
                    if ($sim < self::SIMILARITY_THRESHOLD) {
                        continue;
                    }

                    $numerator += $sim * $rating;
                    $denominator += abs($sim);
                }

                if ($denominator > 0) {

                    $score = $numerator / $denominator;

                    // batasi hasil prediksi ke skala rating 1-5
                    $predictions[$userId][$productCode] = round(min(5, max(1, $score)),4);
                }
            }
        }

        return $predictions;
    }
    // Ambil rekomendasi top produk per user
    private function getRecommendations($topN = 3)
    {
        $recommendations = [];

        foreach ($this->predictions as $userId => $products) {
            arsort($products);
            $top = array_slice($products, 0, $topN, true);

            foreach ($top as $productCode => $score) {
                $product = $this->products->firstWhere('productCode', $productCode);
                $recommendations[$userId][] = [
                    'productName' => $product?->productName ?? $productCode,
                    'score' => $score,
                ];
            }
        }

        return $recommendations;
    }

    private function getMAEDetails()
    {
        $details = [];

        foreach ($this->matrix as $userId => $ratedProducts) {
            foreach ($ratedProducts as $productCode => $actual) {
                $numerator = 0;
                $denominator = 0;

                foreach ($ratedProducts as $ratedCode => $rating) {
                    if ($ratedCode == $productCode) continue;

                    $sim = $this->similarities[$productCode][$ratedCode] ?? 0;

                    // samakan threshold dengan getPredictions agar selaras
                    if ($sim < self::SIMILARITY_THRESHOLD) {
                        continue;
                    }

                    $numerator += $sim * $rating;
                    $denominator += abs($sim);
                }

                if ($denominator > 0) {
                    $predicted = min(5,max(1,round($numerator / $denominator, 4)));
                    $error = round(abs($actual - $predicted), 4);
                    $user = $this->users->firstWhere('id', $userId);
                    $product = $this->products->firstWhere('productCode', $productCode);

                    $details[] = [
                        'userName' => $user?->name ?? 'User ' . $userId,
                        'productName' => $product?->productName ?? $productCode,
                        'actual' => $actual,
                        'predicted' => $predicted,
                        'error' => $error,
                    ];
                }
            }
        }

        return $details;
    }
}