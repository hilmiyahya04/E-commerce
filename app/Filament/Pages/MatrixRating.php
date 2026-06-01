<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use App\Models\Product;
use App\Models\product_reviews;
use App\Models\User;

class MatrixRating extends Page
{

    protected string $view = 'filament.pages.matrix-rating';

    public $products;

    public $users;

    public $reviews;

    public static function getNavigationGroup(): string
    {
        return 'Collaborative Filtering';
    }

    public static function getNavigationSort(): int
    {
        return 1;
    }

    public function mount()
    {
        $this->products = Product::all();

        $this->users = User::whereIn('id', product_reviews::pluck('userId'))->get();

        $this->reviews = product_reviews::all();
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }
}
