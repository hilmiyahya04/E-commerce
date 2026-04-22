<?php


namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\RelationManagers\ItemsRelationManager;
use App\Filament\Resources\Orders\Pages\CreateOrders;
use App\Filament\Resources\Orders\Pages\EditOrders;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\Schemas\OrdersForm;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-cart';

    protected static string|BackedEnum |null $activeNavigationIcon = 'heroicon-o-document-text';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user) {
            // Hanya admin yang bisa lihat semua order
            if (!$user->hasRole('super_admin')) {
                $query->where('userId', $user->id);
            }
        }

        return $query;
    }

    public static function form(Schema $schema): Schema
    {
        return OrdersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrders::route('/create'),
            'edit' => EditOrders::route('/{record}/edit'),
        ];
    }
}
