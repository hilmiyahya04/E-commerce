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
use App\Notifications\OrderStatusNotification;
use App\Models\product_reviews;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Section;

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
            ->actionsColumnLabel('Aksi')
            ->actions([
                
            ActionsAction::make('lihat_detail')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('Lihat Detail')
                    ->color('primary')
                ->modalHeading(fn ($record) => 'Detail Pesanan #'  . $record->id_pemesanan)
                ->modalContent(fn ($record) => view(
                    'filament.modals.order-detail',
                    ['order' => $record->load('items.product')]
                ))
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup'),

            ActionsAction::make('tracking')
                ->label('')
                ->icon('heroicon-o-map-pin')
                ->tooltip('Lacak Pesanan')
                ->color('primary')
                ->modalHeading(fn ($record) => 'Tracking Pesanan #' . $record->id_pemesanan)
                ->modalContent(fn ($record) => view(
                    'filament.modals.order-tracking',
                    ['order' => $record->load('tracking')]
                ))
                
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup'),

            ActionsAction::make('ajukan_return')
                ->label('')
                ->icon('heroicon-o-arrow-uturn-left')
                ->tooltip('Return & Refund')
                ->color('primary')
                ->visible(fn () => !Auth::user()->hasRole('super_admin'))
                ->modalHeading(fn ($record) => 'Return & Refund - #' . $record->id_pemesanan)
                ->modalContent(function ($record) {
                    $user = Auth::user();
                    $record->load(['returns.orderItem', 'returns.refund', 'refunds', 'items']);

                    $existingReturn = \App\Models\ReturnModel::whereIn('order_item_id', $record->items->pluck('id'))
                        ->where('user_id', $user->id)
                        ->exists();

                    if ($existingReturn) {
                        return view('filament.modals.order-return-refund', [
                            'order'   => $record,
                            'isAdmin' => false,
                        ]);
                    }

                    return null;
                })
                ->form(function ($record) {
                    $user = Auth::user();
                    $record->load('items');

                    $existingReturn = \App\Models\ReturnModel::whereIn('order_item_id', $record->items->pluck('id'))
                        ->where('user_id', $user->id)
                        ->exists();

                    if ($existingReturn) return [];

                    return [
                        \Filament\Forms\Components\Select::make('order_item_id')
                            ->label('Pilih Produk')
                            ->options($record->items->pluck('product_name', 'id')->toArray())
                            ->required()
                            ->searchable(),

                        \Filament\Forms\Components\Textarea::make('reason')
                            ->label('Alasan Return')
                            ->required()
                            ->rows(3),

                        \Filament\Forms\Components\FileUpload::make('image')
                            ->label('Foto Bukti')
                            ->image()
                            ->directory('returns'),
                    ];
                })
                ->action(function ($record, array $data) {
                    if (empty($data)) return;

                    \App\Models\ReturnModel::create([
                        'order_item_id' => $data['order_item_id'],
                        'user_id'       => Auth::id(),
                        'reason'        => $data['reason'],
                        'image'         => $data['image'] ?? null,
                        'status'        => 'pending',
                    ]);

                    \Filament\Notifications\Notification::make()
                        ->title('Pengajuan return berhasil dikirim!')
                        ->success()
                        ->send();
                })
                ->modalSubmitActionLabel('Ajukan Return')
                ->modalCancelActionLabel('Tutup'),

            ActionsAction::make('lihat_return')
                ->label('')
                ->icon('heroicon-o-arrow-uturn-left')
                ->tooltip('Return & Refund')
                ->color('primary')
                ->visible(fn () => Auth::user()->hasRole('super_admin'))
                ->modalHeading(fn ($record) => 'Return & Refund - #' . $record->id_pemesanan)
                ->modalContent(fn ($record) => view('filament.modals.order-return-refund', [
                    'order'   => $record->load(['returns.orderItem', 'returns.refund', 'refunds']),
                    'isAdmin' => true,
                ]))
                ->modalFooterActions(function ($record) {
                    $record->load(['returns.orderItem', 'refunds']);
                    $actions = [];

                    foreach ($record->returns as $return) {
                        if ($return->status === 'pending') {
                            $actions[] = ActionsAction::make('approve_return_' . $return->id)
                                ->label('Setuju')
                                ->color('success')
                                ->action(function () use ($return) {
                                    $return->update(['status' => 'approved']);

                                    $alreadyRefunded = \App\Models\Refund::where('return_id', $return->id)->exists();
                                    if (!$alreadyRefunded) {
                                        \App\Models\Refund::create([
                                            'return_id'   => $return->id,
                                            'order_id'    => $return->orderItem->order_id,
                                            'amount'      => $return->orderItem->price,
                                            'status'      => 'pending',
                                            'refunded_at' => null,
                                        ]);
                                    }

                                    \Filament\Notifications\Notification::make()
                                        ->title('Return disetujui, refund dibuat!')
                                        ->success()
                                        ->send();
                                });

                            $actions[] = ActionsAction::make('reject_return_' . $return->id)
                                ->label('Tolak')
                                ->color('danger')
                                ->action(function () use ($return) {
                                    $return->update(['status' => 'rejected']);

                                    \Filament\Notifications\Notification::make()
                                        ->title('Return ditolak.')
                                        ->warning()
                                        ->send();
                                });
                        }
                    }

                    foreach ($record->refunds as $refund) {
                        if ($refund->status === 'pending') {
                            $actions[] = ActionsAction::make('complete_refund_' . $refund->id)
                                ->label('Selesaikan Refund')
                                ->color('gray')
                                ->extraAttributes([
                                    'style' => 'background-color: #9ca3af; color: #030712; border: none;'
                                ])
                                ->action(function () use ($refund) {
                                    $refund->update([
                                        'status'      => 'completed',
                                        'refunded_at' => now(),
                                    ]);

                                    \Filament\Notifications\Notification::make()
                                        ->title('Refund berhasil diselesaikan!')
                                        ->success()
                                        ->send();
                                });
                                
                        }
                    }

                    return $actions;
                })
                ->modalSubmitAction(false)  
                ->modalCancelActionLabel('Tutup'),

                ActionsAction::make('reviews')
                ->label('')
                ->icon('heroicon-o-star')
                ->color('primary')
                ->tooltip('Review Produk')
                    ->visible(function () {
                    /** @var User|null $user */
                    $user = Auth::user();
                    return $user && !$user->hasRole('super_admin'); 
                })  
                ->modalHeading(fn ($record) => 'Review Produk - #' . $record->id_pemesanan)
                ->form(function ($record) {
                    $record->load('items.product');

                    $productOptions = $record->items
                        ->mapWithKeys(fn ($item) => [
                            $item->product->productCode => $item->product->productName
                        ])
                        ->toArray();

                    return [
                        Select::make('productCode')
                            ->label('Pilih Produk')
                            ->options($productOptions)
                            ->required()
                            ->searchable(),

                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                5 => '⭐⭐⭐⭐⭐ - Sangat Bagus',
                                4 => '⭐⭐⭐⭐ - Bagus',
                                3 => '⭐⭐⭐ - Cukup',
                                2 => '⭐⭐ - Buruk',
                                1 => '⭐ - Sangat Buruk',
                            ])
                            ->required(),
                    ];
                })
                ->action(function ($record, array $data) {
                    product_reviews::updateOrCreate(
                        [
                            'userId'      => $record->userId,
                            'productCode' => $data['productCode'],
                        ],
                        [
                            'rating' => $data['rating'],
                        ]
                    );

                    \Filament\Notifications\Notification::make()
                        ->title('Review berhasil disimpan!')
                        ->success()
                        ->send();
                })
                ->modalSubmitActionLabel('Simpan Review')   
                ->modalCancelActionLabel('Batal'),

                ActionsAction::make('lihat_reviews')
                ->label('') 
                ->icon('heroicon-o-eye')
                ->tooltip('Lihat Review')
                ->color('primary')
                ->modalHeading(fn ($record) => 'Review Produk - #' . $record->id_pemesanan)
                ->modalContent(function ($record) {
                    $record->load('items.product');

                    $productCodes = $record->items
                        ->pluck('product.productCode')
                        ->filter()
                        ->toArray();

                    $reviews = product_reviews::with('product')
                        ->where('userId', $record->userId)
                        ->whereIn('productCode', $productCodes)
                        ->get();

                    return view('filament.modals.order-review-list', [
                        'reviews' => $reviews,
                    ]);
                })
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Tutup')
                ->visible(function () {
                    /** @var User|null $user */
                    $user = Auth::user();
                    return $user && $user->hasRole('super_admin');
                }),

                EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Delete User')
                    ->visible(function () {
                            /** @var User|null $user */
                            $user = Auth::user();
                            return $user && $user->hasRole('super_admin');
                        }),

                ActionGroup::make([
                    ActionsAction::make('Pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['orderStatus' => 'pending']);

                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'pending',
                                'remarks' => 'Pesanan diterima oleh admin',
                            ]);

                            $record->user->notify(
                                new OrderStatusNotification($record, 'pending')
                            );
                        })
                        ->visible(fn () => Auth::user()?->hasRole('super_admin')),

                    ActionsAction::make('Process')
                        ->label('Proses')
                        ->icon('heroicon-o-cog')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update(['orderStatus' => 'processed']);

                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'processed',
                                'remarks' => 'Pesanan diproses oleh admin',
                            ]);

                            $record->user->notify(
                                new OrderStatusNotification($record, 'processed')
                            );
                        })
                        ->visible(fn () => Auth::user()?->hasRole('super_admin')),

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

                            $record->user->notify(
                                new OrderStatusNotification($record, 'shipped')
                            );
                        })
                        ->visible(fn () => Auth::user()?->hasRole('super_admin')),
                ])
                    ->label('Status')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->size('sm'),

                ActionGroup::make([
                    ActionsAction::make('completed')
                        ->label('Selesai')
                        ->icon('heroicon-o-check')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            if ($record->orderStatus === 'cancelled') {
                                return;
                            }

                            $record->update([
                                'orderStatus' => 'completed',
                            ]);

                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'completed',
                                'remarks' => 'Pesanan selesai',
                            ]);

                            $record->user->notify(
                                new OrderStatusNotification($record, 'completed')
                            );
                        })
                        ->visible(fn () => Auth::user()?->hasRole('super_admin')),

                    ActionsAction::make('Cancel')
                        ->label('Batalkan')
                        ->icon('heroicon-o-x-mark')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->update([
                                'orderStatus' => 'cancelled',
                            ]);

                            product_order_track_histories::create([
                                'orderId' => $record->id,
                                'status'  => 'cancelled',
                                'remarks' => 'Pesanan dibatalkan',
                            ]);

                            $record->user->notify(
                                new OrderStatusNotification($record, 'cancelled')
                            );
                        })
                        ->visible(fn () => Auth::user()?->hasRole('super_admin')),
                ])
                    ->label('Status Akhir')
                    ->icon('heroicon-o-flag')
                    ->color('primary')
                    ->size('sm'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
