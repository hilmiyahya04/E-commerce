<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('productCode')
                    ->required(),
                TextInput::make('productName')
                    ->required(),
                TextInput::make('productCompany'),
                TextInput::make('productPrice')
                    ->required()
                    ->numeric(),
                FileUpload::make('productImage1')
                    ->image()
                    ->disk('public')
                    ->directory('product')
                    ->imagePreviewHeight('100')
                    ->preserveFilenames(),
                TextInput::make('productAvailability'),
                DatePicker::make('postingDate'),
                TextInput::make('categoryId')
                    ->numeric(),
            ]);
    }
}
