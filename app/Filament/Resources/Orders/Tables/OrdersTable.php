<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\User;
use Filament\Actions\ActionGroup;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use App\Models\product_order_track_histories;
use App\Filament\Resources\Orders\OrdersResource;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userId')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('orderDate')
                    ->date()
                    ->sortable(),
                TextColumn::make('paymentMethod')
                    ->searchable(),
                TextColumn::make('orderStatus')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('id_pemesanan')
                    ->searchable(),
                TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square'),

                ActionGroup::make([
                    ActionsAction::make('ship')
                        ->label('Kirim')
                        ->icon('heroicon-o-truck')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['orderStatus' => 'shipped']);
                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'shipped',
                                'remarks' => 'Pesanan dikirim oleh admin',
                            ]);
                        })
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('process')
                        ->label('Proses')
                        ->icon('heroicon-o-cog')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            if ($record->orderStatus === 'cancelled') {
                                return;
                            }
                            $record->update(['orderStatus' => 'processed']);
                        })
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('complete')
                        ->label('Selesai')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            if ($record->orderStatus === 'cancelled') {
                                return;
                            }
                            $record->update(['orderStatus' => 'completed']);
                        })
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('confirm')
                        ->label('Konfirmasi')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['orderStatus' => 'paid']))
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('cancel')
                        ->label('Batalkan')
                        ->icon('heroicon-o-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['orderStatus' => 'cancelled']))
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-o-ellipsis-horizontal-circle')
                    ->color('primary')
                    ->size('sm')
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
