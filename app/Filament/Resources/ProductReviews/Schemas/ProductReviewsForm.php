<?php

namespace App\Filament\Resources\ProductReviews\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;



class ProductReviewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('userId')
                    ->default(fn() => Auth::id()),

                TextInput::make('productCode')
                    ->required(),

                Select::make('rating')
                    ->options([
                        5 => '⭐⭐⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        3 => '⭐⭐⭐',
                        2 => '⭐⭐',
                        1 => '⭐',
                    ])
                    ->required(),
            ]);
    }
}
