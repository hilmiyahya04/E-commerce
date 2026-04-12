<?php

namespace App\Filament\Pages;


use Filament\Pages\Dashboard as BaseDashboard;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Dashboard extends BaseDashboard
{
    use HasPageShield;
    protected static ?string $title = 'Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\DashboardOverview::class,
            \App\Filament\Widgets\BlogPostsChart::class,
        ];
    }
}
