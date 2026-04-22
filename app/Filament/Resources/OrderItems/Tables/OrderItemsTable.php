<?php

namespace App\Filament\Resources\OrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.id')
                    ->label('Order ID'),
                TextColumn::make('product_name')
                    ->label('Produk'),
                TextColumn::make('price')
                    ->money('IDR'),
                TextColumn::make('qty')
                    ->label('qty'),
                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->getStateUsing(fn($record) => $record->price * $record->quantity),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
