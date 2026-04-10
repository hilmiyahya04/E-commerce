<?php

namespace App\Filament\Widgets;

use \App\Models\User;
use App\Models\categories;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $countProducts = Product::count();
        $countCategories =  categories::count();
        $countUser =  User::count();
        return [
            Stat::make('Jumlah Produk', $countProducts . ' Produk'),
            Stat::make('Kategori Brand', $countCategories . ' Kategori'),
            Stat::make('Account User', $countUser . ' User'),
        ];
    }
}
