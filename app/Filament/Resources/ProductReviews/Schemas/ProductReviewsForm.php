<?php

namespace App\Filament\Resources\ProductReviews\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;


class ProductReviewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('userId')
                    ->default(Auth::id()),

                TextInput::make('productCode')
                    ->required(),

                TextInput::make('rating')
                    ->numeric()
                    ->required(),
            ]);
    }
}
