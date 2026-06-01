<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\orders;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Shipped',
                orders::where('orderStatus', 'Shipped')->count()
            ),

            Stat::make(
                'Processed',
                orders::where('orderStatus', 'Processed')->count()
            ),

            Stat::make(
                'Completed',
                orders::where('orderStatus', 'Completed')->count()
            ),

            Stat::make(
                'Canceled',
                orders::where('orderStatus', 'Canceled')->count()
            ),

        ];
    }
}
