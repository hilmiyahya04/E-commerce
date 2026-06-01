<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\product_reviews;
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

        $orders = orders::where('orderStatus', 'Completed')
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

        $reviews = product_reviews::all();
        foreach ($reviews as $review) {
            $matrix[$review->userId][$review->productCode] = $review->rating;
        }

        return $matrix;
    }

    // Hitung cosine similarity
    private function cosineSimilarity($ratingsA, $ratingsB)
    {
        $commonProducts = array_intersect_key($ratingsA, $ratingsB);
        if (empty($commonProducts)) return 0;

        $dotProduct = 0;
        $magnitudeA = 0;
        $magnitudeB = 0;

        foreach ($commonProducts as $code => $rating) {
            $dotProduct += $ratingsA[$code] * $ratingsB[$code];
        }
        foreach ($ratingsA as $r) $magnitudeA += $r * $r;
        foreach ($ratingsB as $r) $magnitudeB += $r * $r;

        $magnitude = sqrt($magnitudeA) * sqrt($magnitudeB);
        return $magnitude > 0 ? round($dotProduct / $magnitude, 4) : 0;
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
                if (isset($ratedProducts[$productCode])) continue;

                $numerator = 0;
                $denominator = 0;

                foreach ($ratedProducts as $ratedCode => $rating) {
                    $sim = $this->similarities[$productCode][$ratedCode] ?? 0;
                    if ($sim <= 0) continue;

                    $numerator += $sim * $rating;
                    $denominator += abs($sim);
                }

                if ($denominator > 0) {
                    $predictions[$userId][$productCode] = round($numerator / $denominator, 4);
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
                    if ($sim <= 0) continue;

                    $numerator += $sim * $rating;
                    $denominator += abs($sim);
                }

                if ($denominator > 0) {
                    $predicted = round($numerator / $denominator, 4);
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
