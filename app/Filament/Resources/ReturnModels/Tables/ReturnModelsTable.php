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
use Filament\Actions\Action as ActionsAction;


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
                        'approved'  => 'success',   
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
            ->actionsColumnLabel('Aksi')
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
                    ->color('primary')
                    ->size('sm')
                    ->tooltip('Hapus Return'),

                ActionGroup::make([

                    Action::make('pending')
                        ->label('Pending')
                        ->icon('heroicon-o-clock')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'pending'])),

                    Action::make('processed')
                        ->label('Processed')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->action(fn($record) => $record->update(['status' => 'processed'])),
                    
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
                ])
                    ->label('Aksi')
                    ->icon('heroicon-o-arrow-path')
                    ->color('primary')
                    ->size('sm')
                    ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),
                
                        ActionGroup::make([
                            ActionsAction::make('Selesai')
                                ->label('Selesai')
                                ->icon('heroicon-o-check')
                                ->color('primary')
                                ->modalHeading('Selesaikan Return')
                                ->modalDescription('Apakah anda yakin ingin menyelesaikan return ini?')
                                ->modalSubmitActionLabel('Ya, Selesai')
                                ->modalCancelActionLabel('Batal')
                                ->requiresConfirmation()
                                ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin']))
                                ->action(fn($record) => $record->update(['status' => 'completed'])),

                            ActionsAction::make('Tolak')
                                ->label('Tolak')
                                ->icon('heroicon-o-x-mark')
                                ->color('primary')   
                                ->modalDescription('Apakah anda yakin ingin menolak return ini?')
                                ->modalSubmitActionLabel('Ya, Tolak')
                                ->modalCancelActionLabel('Batal')   
                                ->requiresConfirmation() 
                                ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'super_admin']))
                                ->action(fn($record) => $record->update(['status' => 'rejected'])),
                        ])
                    ->label('Status')
                    ->icon('heroicon-o-flag')
                    ->color('primary')
                    ->size('sm'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->hidden(fn() => !Auth::user()?->hasRole('super_admin')),
                ]),
            ]);
    }
}