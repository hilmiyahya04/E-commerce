<?php

namespace App\Filament\Resources\ProductOrderTrackHistories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProductOrderTrackHistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('orderId')
                    ->label('Order ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'pending' => 'gray',
                        'diproses' => 'warning',
                        'dikirim' => 'info',
                        'completed' => 'success',
                        default => 'secondary',
                    }),

                TextColumn::make('remarks')
                    ->label('Keterangan')
                    ->limit(30),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
