<?php

namespace App\Filament\Resources\Refunds\Tables;

use Illuminate\Support\Facades\Auth;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;


use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;

class RefundsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)

            ->columns([

                TextColumn::make('return_id')
                    ->label('Return Order'),

                TextColumn::make('amount')
                    ->label('Harga'),

                TextColumn::make('order.id_pemesanan')
                    ->label('Code'),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'approved',
                        'success' => 'completed',
                        'danger' => 'rejected',
                    ]),

            ])

            ->filters([
                //
            ])

            ->actions([
                EditAction::make()

                    ->hidden(
                        fn() =>
                        ! Auth::user()?->roles
                            ->pluck('name')
                            ->contains('super_admin')
                    )

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

                    Action::make('completed')
                        ->label('Completed')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'completed',
                            ]);
                        }),

                    Action::make('failed')
                        ->label('Failed')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($record) {
                            $record->update([
                                'status' => 'failed',
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

            ->bulkActions([

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),

            ]);
    }
}
