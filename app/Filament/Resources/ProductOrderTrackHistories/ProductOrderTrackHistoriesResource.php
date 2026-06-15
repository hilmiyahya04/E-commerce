<?php

namespace App\Filament\Resources\ProductOrderTrackHistories;

use App\Filament\Resources\ProductOrderTrackHistories\Pages\CreateProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Pages\EditProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Pages\ListProductOrderTrackHistories;
use App\Filament\Resources\ProductOrderTrackHistories\Schemas\ProductOrderTrackHistoriesForm;
use App\Filament\Resources\ProductOrderTrackHistories\Tables\ProductOrderTrackHistoriesTable;
use App\Models\product_order_track_histories;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProductOrderTrackHistoriesResource extends Resource
{
    protected static ?string $model = product_order_track_histories::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static string|BackedEnum |null $activeNavigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Riwayat Pelacakan Produk';

    protected static ?string $modelLabel = 'Riwayat Pelacakan Produk';

    protected static ?string $pluralModelLabel = 'Riwayat Pelacakan Produk';


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // admin lihat semua
        if ($user->hasRole('super_admin')) {
            return $query;
        }

        // user biasa
        return $query->whereHas('order', function ($q) use ($user) {
            $q->where('userId', $user->id);
        });
    }

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
            // 'edit' => EditProductOrderTrackHistories::route('/{record}/edit'),
        ];
    }
}
