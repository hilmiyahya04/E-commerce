<?php

namespace App\Filament\Resources\ReturnModels\Tables;

use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;

class ReturnModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([

                TextColumn::make('orderItem.product_name')
                    ->label('Order Item'),

                TextColumn::make('user.name')
                    ->label('User')
                    ->hidden(
                        fn() =>
                        !Auth::user()?->roles
                            ->pluck('name')
                            ->contains('super_admin')
                    ),

                TextColumn::make('reason')
                    ->limit(30),

                ImageColumn::make('image')
                    ->label('Bukti'),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'approved',
                        'success' => 'completed',
                        'danger' => 'rejected',
                    ]),

                TextColumn::make('admin_note')
                    ->label('Catatan Admin'),

            ])

            ->headerActions([])

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
