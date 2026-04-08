<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('productCode')
                    ->searchable(),
                TextColumn::make('productName')
                    ->searchable(),
                TextColumn::make('productCompany')
                    ->searchable(),
                TextColumn::make('productPrice')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('productImage1')
                    ->disk('public'),
                TextColumn::make('productAvailability')
                    ->searchable(),
                TextColumn::make('  postingDate')
                    ->date()
                    ->sortable(),
                TextColumn::make('categoryId')
                    ->numeric()
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
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
