<?php

namespace App\Filament\Resources\Refunds\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Auth;

class RefundForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('return_id')
                    ->relationship('returnModel', 'reason')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('order_id')
                    ->relationship('order', 'id_pemesanan')
                    ->required(),

                TextInput::make('amount')
                    ->numeric()
                    ->required(),

            ]);
    }
}
