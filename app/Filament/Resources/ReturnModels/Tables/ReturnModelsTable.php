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
use App\Models\Refund;

class ReturnModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([

                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),

                TextColumn::make('orderItem.product_name')
                    ->label('Nama Produk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('reason')
                    ->label('Alasan')
                    ->limit(50),

                ImageColumn::make('image')
                    ->label('Bukti Foto')
                    ->circular(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state) => match (strtolower($state)) {
                        'pending'   => 'warning',
                        'approved'  => 'primary',
                        'processed' => 'info',
                        'completed' => 'success',
                        'rejected'  => 'danger',
                        'failed'    => 'danger',
                        default     => 'gray',
                    }),

                TextColumn::make('admin_note')
                    ->label('Catatan Admin')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->headerActions([])
            ->filters([
                //
            ])
            ->actions([

                EditAction::make()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin'))
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Edit Return')
                    ->modalHeading('Edit Return')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalWidth('lg'),

                DeleteAction::make()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin'))
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Hapus Return'),

                ActionGroup::make([

                    Action::make('pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'pending'])),

                    Action::make('approved')
                        ->label('Approved')
                        ->icon('heroicon-o-hand-thumb-up')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                        $record->update(['status' => 'approved']);

                        $refundExists = Refund::where('return_id', $record->id)->exists();

                        if (!$refundExists) {
                            Refund::create([
                                'order_id'  => $record->orderItem->order_id,
                                'return_id' => $record->id,
                                'amount'    => $record->orderItem->price * $record->orderItem->qty,
                                'status'    => 'pending',
                            ]);
                        }
                    }),

                    Action::make('processed')
                        ->label('Processed')
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'processed'])),

                    Action::make('completed')
                        ->label('Completed')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'completed'])),

                    Action::make('rejected')
                        ->label('Rejected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'rejected'])),

                ])
                    ->label('Aksi')
                    ->icon('heroicon-o-ellipsis-horizontal-circle')
                    ->color('primary')
                    ->size('sm')
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),
                ]),
            ]);
    }
}