<?php

namespace App\Filament\Resources\ProductOrderTrackHistories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ProductOrderTrackHistoriesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('orderId')
                    ->relationship('order', 'id')
                    ->required(),
                Select::make('userId')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('remarks')
                    ->required(),
            ]);
    }
}
