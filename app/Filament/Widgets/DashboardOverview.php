<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\categories;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

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

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'super_admin';
    }
}
