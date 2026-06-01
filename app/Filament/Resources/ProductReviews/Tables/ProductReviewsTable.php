<?php

namespace App\Filament\Resources\ProductReviews\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;

use Filament\Forms\Components\Select;

use Illuminate\Support\Facades\Auth;

class ProductReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([

                TextColumn::make('productCode')
                    ->label('Kode Produk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(
                        fn($state) => str_repeat('⭐', $state)
                    )
                    ->sortable(),

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

                    // ->hidden(
                    //     fn() =>
                    //     ! Auth::user()?->roles
                    //         ->pluck('name')
                    //         ->contains('super_admin')
                    // )
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->size('sm')
                    ->tooltip('Delete User'),

                Action::make('beri_rating')
                    ->label('Beri Rating')
                    ->icon('heroicon-o-star')
                    ->color('warning')

                    ->hidden(true)


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

            ->bulkActions([

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),

            ]);
    }
}
