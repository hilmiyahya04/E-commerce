<?php

namespace App\Filament\Widgets;

use App\Models\Orders;
use App\Models\User;
use App\Models\categories;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class DashboardOverview extends StatsOverviewWidget
{

    use HasWidgetShield;
    protected function getStats(): array
    {
        $countProducts = Product::count();
        $countCategories =  categories::count();
        $countUser =  User::count();
        $countOrders =  Orders::count();
        return [
            Stat::make('Jumlah Produk', $countProducts . ' Produk'),
            Stat::make('Kategori Brand', $countCategories . ' Kategori'),
            Stat::make('Akun User', $countUser . ' User'),
            Stat::make('Pesanan', $countOrders . ' Pesanan'),

        ];
    }
}
