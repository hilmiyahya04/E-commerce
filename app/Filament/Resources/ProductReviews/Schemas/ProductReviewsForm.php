<?php

namespace App\Filament\Resources\ProductReviews\Schemas;

use App\Models\product;
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
                // user otomatis login
                Hidden::make('userId')
                    ->default(fn() => Auth::id()),

                // pilih produk (lebih aman daripada input text)
                Select::make('productCode')
                    ->label('Produk')
                    ->options(
                        product::pluck('productCode', 'productCode')
                    )
                    ->searchable()
                    ->required(),

                // rating
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
