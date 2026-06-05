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
                ->label('ID Pemesanan')
                ->relationship('order', 'id_pemesanan')
                ->searchable()
                ->required(),

            Select::make('product_id')
                ->label('Nama Produk')
                ->relationship('product', 'productName')
                ->searchable()
                ->required(),

            TextInput::make('price')
                ->numeric()
                ->required(),

            TextInput::make('qty')
                ->numeric()
                ->required(),
        ]);
    }
}
