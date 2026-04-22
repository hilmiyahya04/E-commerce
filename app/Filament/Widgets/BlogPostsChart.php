<?php

namespace App\Filament\Widgets;

use App\Models\orders;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class BlogPostsChart extends ChartWidget
{
    use HasWidgetShield;

    protected ?string $heading = 'Penjualan perbulan    ';

    protected function getData(): array
    {
        $data = collect(range(1, 12))->map(function ($month) {
            return orders::whereMonth('created_at', $month)->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Order',
                    'data' => $data,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}
