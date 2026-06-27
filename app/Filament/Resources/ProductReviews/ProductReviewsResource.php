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
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\CreateAction;

class ProductReviewsResource extends Resource
{
    protected static ?string $model = product_reviews::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Review Produk';

    protected static ?string $modelLabel = 'Review Produk';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // admin lihat semua
        if ($user->hasRole('super_admin')) {
            return $query;
        }

        return $query->where('userId', $user->id);
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
        ];
    }
}
