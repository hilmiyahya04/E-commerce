<?php

namespace App\Filament\Resources\Productdetails\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ProductdetailsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('orderId')
                    ->relationship('order', 'id')
                    ->required(),

                Select::make('productId')
                    ->relationship('product', 'id')
                    ->required(),

                TextInput::make('quantity')
                    ->numeric()
                    ->required(),
            ]);
    }
}
