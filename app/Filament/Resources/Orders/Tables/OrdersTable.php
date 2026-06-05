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
use Filament\Actions\DeleteAction;
use App\Filament\Resources\Orders\OrdersResource;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id_pemesanan')
                    ->label('ID Pemesanan')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),
                TextColumn::make('orderDate')
                    ->label('Tanggal Pemesanan')
                    ->date()
                    ->sortable(),
                TextColumn::make('paymentMethod')
                    ->label('Metode Pembayaran')
                    ->searchable(),
                TextColumn::make('orderStatus')
                    ->label('Status Pemesanan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending'   => 'warning',
                        'paid'      => 'success',
                        'processed' => 'info',
                        'shipped'   => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('total_price')
                    ->label('Total')
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

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Delete User'),

                ActionGroup::make([
                    ActionsAction::make('Pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['orderStatus' => 'Pending']);
                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'pending',
                                'remarks' => 'Pesanan diterima oleh admin',
                            ]);
                        })
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('Process')
                        ->label('Proses')
                        ->icon('heroicon-o-cog')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['orderStatus' => 'processed']);
                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'processed',
                                'remarks' => 'Pesanan diproses oleh admin',
                            ]);
                        })
                        ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                    ActionsAction::make('Shipped')
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

                    ActionsAction::make('completed')
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

                    ActionsAction::make('Cancel')
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
