<?php

namespace App\Services;

use App\Models\product_reviews;
use App\Models\orders;
use App\Models\Product;

class RecommendationService
{
    private $matrix = [];
    private $similarities = [];
    private $products;

    public function __construct()
    {
        $this->products = Product::all();
        $this->matrix = $this->buildMatrix();
        $this->similarities = $this->buildSimilarityTable();
    }

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

    public function getRecommendations($userId, $topN = 3)
    {
        if (!isset($this->matrix[$userId])) {
            return collect();
        }

        $ratedProducts = $this->matrix[$userId];
        $productCodes = $this->products->pluck('productCode')->toArray();
        $predictions = [];

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
                $predictions[$productCode] = round($numerator / $denominator, 4);
            }
        }

        arsort($predictions);
        $topCodes = array_slice(array_keys($predictions), 0, $topN);

        return Product::whereIn('productCode', $topCodes)->get();
    }
}
