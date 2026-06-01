<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrdersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('userId')
                    ->required()
                    ->numeric(),
                DatePicker::make('orderDate'),
                TextInput::make('paymentMethod'),
                TextInput::make('orderStatus')
                    ->hidden(true),
                TextInput::make('id_pemesanan')
                    ->required(),
            ]);
    }
}
