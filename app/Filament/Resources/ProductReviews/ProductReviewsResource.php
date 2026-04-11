<?php

namespace App\Filament\Resources\ProductReviews;

use App\Filament\Resources\ProductReviews\Pages\CreateProductReviews;
use App\Filament\Resources\ProductReviews\Pages\EditProductReviews;
use App\Filament\Resources\ProductReviews\Pages\ListProductReviews;
use App\Filament\Resources\ProductReviews\Schemas\ProductReviewsForm;
use App\Filament\Resources\ProductReviews\Tables\ProductReviewsTable;
use App\Models\product_reviews;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductReviewsResource extends Resource
{
    protected static ?string $model = product_reviews::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static string|BackedEnum |null $activeNavigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 6;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Schema $schema): Schema
    {

        return ProductReviewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductReviewsTable::configure($table);
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
            'index' => ListProductReviews::route('/'),
            'create' => CreateProductReviews::route('/create'),
            'edit' => EditProductReviews::route('/{record}/edit'),
        ];
    }
}
