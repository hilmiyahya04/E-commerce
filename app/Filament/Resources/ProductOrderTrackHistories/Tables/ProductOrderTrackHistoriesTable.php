<?php

namespace App\Filament\Resources\ProductOrderTrackHistories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Support\Facades\Auth;

class ProductOrderTrackHistoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('order.id_pemesanan')
                    ->label('ID Pemesanan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('order.user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state) => match (strtolower($state)) {
                        'pending'   => 'warning',
                        'processed' => 'info',
                        'shipped'   => 'primary',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        'completed' => 'success',
                        default     => 'gray',
                    }),

                TextColumn::make('remarks')
                    ->label('Keterangan')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actionsColumnLabel('Aksi')
            ->actions([

                EditAction::make()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin'))
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Edit Tracking')
                    ->modalHeading('Edit Tracking Pesanan')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalWidth('lg'),

                DeleteAction::make()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin'))
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Hapus Tracking'),
                ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),
                ]),
            ]);
    }
}