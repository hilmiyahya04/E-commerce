<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;

class ItemsRelationManager extends RelationManager
{

    protected static string $relationship = 'items';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('product.productImage1')
                    ->disk('public')
                    ->label('Gambar'),

                Tables\Columns\TextColumn::make('product.productName')
                    ->label('Nama Produk'),

                Tables\Columns\TextColumn::make('qty')
                    ->label('Qty'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->label('Harga'),
            ])
            ->headerActions([
                // CreateAction::make(),
            ])
            ->striped()
            ->paginated(false);
    }
}
