<?php

namespace App\Filament\Resources\Productdetails;

use App\Filament\Resources\Productdetails\Pages\CreateProductdetails;
use App\Filament\Resources\Productdetails\Pages\EditProductdetails;
use App\Filament\Resources\Productdetails\Pages\ListProductdetails;
use App\Filament\Resources\Productdetails\Schemas\ProductdetailsForm;
use App\Filament\Resources\Productdetails\Tables\ProductdetailsTable;
use App\Models\product_details;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductdetailsResource extends Resource
{
    protected static ?string $model = product_details::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-information-circle';

    protected static string|BackedEnum |null $activeNavigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {
        return ProductdetailsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductdetailsTable::configure($table);
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
            'index' => ListProductdetails::route('/'),
            'create' => CreateProductdetails::route('/create'),
            'edit' => EditProductdetails::route('/{record}/edit'),
        ];
    }
}
