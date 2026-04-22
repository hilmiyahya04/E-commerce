<?php

namespace App\Filament\Resources\OrderItems\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class OrderItemsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Select::make('order_id')
                ->relationship('order', 'id')
                ->required(),

            Select::make('product_id')
                ->relationship('product', 'product_name')
                ->required(),

            TextInput::make('product_name')
                ->required(),

            TextInput::make('price')
                ->numeric()
                ->required(),

            TextInput::make('quantity')
                ->numeric()
                ->required(),

            TextInput::make('subtotal')
                ->numeric()
                ->required(),
        ]);
    }
}
