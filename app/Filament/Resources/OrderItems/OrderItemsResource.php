<?php

namespace App\Filament\Resources\OrderItems;

use App\Filament\Resources\OrderItems\Pages\CreateOrderItems;
use App\Filament\Resources\OrderItems\Pages\EditOrderItems;
use App\Filament\Resources\OrderItems\Pages\ListOrderItems;
use App\Filament\Resources\OrderItems\Schemas\OrderItemsForm;
use App\Filament\Resources\OrderItems\Tables\OrderItemsTable;
use App\Models\order_items;
use App\Models\OrderItems;
use App\Models\orders_items;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use UnitEnum;

class OrderItemsResource extends Resource
{
    protected static ?string $model = order_items::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-identification';

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel =  'Detail Item Pesanan';

    protected static ?string $modelLabel = 'Detail Item Pesanan';

    protected static ?string $pluralModelLabel = 'Detail Item Pesanan';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // admin lihat semua
        if ($user->hasRole('super_admin')) {
            return $query;
        }

        return $query->whereHas('order', function ($q) use ($user) {
            $q->where('userId', $user->id);
        });
    }

    public static function form(Schema $schema): Schema
    {
        return OrderItemsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderItemsTable::configure($table);
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
            'index' => ListOrderItems::route('/'),
        ];
    }
}
