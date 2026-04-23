<?php

namespace App\Filament\Resources\ProductReviews\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;

class ProductReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('productCode')
                    ->label('Product Code')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(fn($state) => str_repeat('⭐', $state))
                    ->sortable(),
            ])

            ->filters([
                //
            ])

            ->actions([
                EditAction::make(),

                Action::make('beri_rating')
                    ->label('Beri Rating')
                    ->icon('heroicon-o-star')
                    ->color('warning')
                    ->form([
                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '⭐',
                                2 => '⭐⭐',
                                3 => '⭐⭐⭐',
                                4 => '⭐⭐⭐⭐',
                                5 => '⭐⭐⭐⭐⭐',
                            ])
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->rating = $data['rating'];
                        $record->save();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
