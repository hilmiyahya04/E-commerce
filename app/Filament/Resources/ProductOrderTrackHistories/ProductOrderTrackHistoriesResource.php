<?php

namespace App\Filament\Resources\ProductOrderTrackHistories;

use App\Filament\Resources\ProductOrderTrackHistories\Pages\CreateProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Pages\EditProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Pages\ListProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Schemas\ProductOrderTrackHistoriesForm;
use App\Filament\Resources\ProductOrderTrackHistories\Tables\ProductOrderTrackHistoriesTable;
use App\Models\product_order_track_histories;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductOrderTrackHistoriesResource extends Resource
{
    protected static ?string $model = product_order_track_histories::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProductOrderTrackHistoriesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductOrderTrackHistoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductOrderTrackHistories::route('/'),
            'create' => CreateProductOrderTrackHistories::route('/create'),
            'edit' => EditProductOrderTrackHistories::route('/{record}/edit'),
        ];
    }
}
