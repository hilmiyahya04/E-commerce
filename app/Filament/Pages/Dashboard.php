<?php

namespace App\Filament\Pages;


use Filament\Pages\Dashboard as BaseDashboard;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Dashboard extends BaseDashboard
{

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            // \App\Filament\Widgets\DashboardOverview::class,
            // \App\Filament\Widgets\BlogPostsChart::class,
        ];
    }
}
