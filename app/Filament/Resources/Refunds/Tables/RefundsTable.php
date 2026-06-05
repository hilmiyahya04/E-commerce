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

                TextColumn::make('order.id_pemesanan')
                    ->label('ID Pemesanan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('order.user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),

                TextColumn::make('return_id')
                    ->label('ID Return')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Jumlah Refund')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state) => match (strtolower($state)) {
                        'pending'   => 'warning',
                        'processed' => 'info',
                        'completed' => 'success',
                        'failed'    => 'danger',
                        default     => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
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
                    ->tooltip('Edit Refund')
                    ->modalHeading('Edit Refund')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalWidth('lg'),

                DeleteAction::make()
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin'))
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Hapus Refund'),

                ActionGroup::make([

                    Action::make('pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'pending'])),

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