<?php

namespace App\Filament\Resources\OrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.id_pemesanan')
                    ->label('ID Pemesanan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product.productName')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('qty')
                    ->label('Qty')
                    ->sortable(),

                TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR', locale: 'id')
                    // SELARAS: Menghitung subtotal langsung dari price dan qty record saat ini
                    ->state(function ($record): float|int {
                        return ($record->price ?? 0) * ($record->qty ?? 0);
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Delete Item'),
            ])
            ->toolbarActions([]);
    }
}
