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
            ->actions([
                EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Edit Review')
                    ->modalHeading('Edit Review Produk')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalWidth('lg'),

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Delete User'),

                ActionGroup::make([

                    Action::make('pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'pending',
                            ]);
                        }),

                    Action::make('processed')
                        ->label('Processed')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'processed',
                            ]);
                        }),

                    Action::make('Shipped')
                        ->label('Shipped')
                        ->icon('heroicon-o-truck')
                        ->color('info')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'shipped',
                            ]);
                        }),

                    Action::make('Delivered')
                        ->label('Delivered')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'delivered',
                            ]);
                        }),

                    Action::make('Cancelled')
                        ->label('Cancelled')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'cancelled',
                            ]);
                        }),

                ])
                    ->label('Aksi')
                    ->icon('heroicon-o-ellipsis-horizontal-circle')
                    ->color('primary')
                    ->size('sm')
                    ->hidden(
                        fn() =>
                        ! Auth::user()?->roles
                            ->pluck('name')
                            ->contains('super_admin')
                    )

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
