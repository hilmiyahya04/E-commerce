<?php

namespace App\Filament\Resources\ReturnModels;

use App\Filament\Resources\ReturnModels\Pages\CreateReturnModel;
use App\Filament\Resources\ReturnModels\Pages\EditReturnModel;
use App\Filament\Resources\ReturnModels\Pages\ListReturnModels;
use App\Filament\Resources\ReturnModels\Schemas\ReturnModelForm;
use App\Filament\Resources\ReturnModels\Tables\ReturnModelsTable;
use App\Models\ReturnModel;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReturnModelResource extends Resource
{
    protected static ?string $model = ReturnModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static UnitEnum|string|null $navigationGroup = 'Shop Management';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationLabel = 'Return';

    protected static ?string $modelLabel = 'Return';

    protected static ?string $pluralModelLabel = 'Return';

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
        return $query->where('id', $user->id);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        if (!Auth::user()->roles->contains('name', 'Super Admin')) {
            $data['user_id'] = Auth::id();
        }

        return $data;
    }

    public static function form(Schema $schema): Schema
    {
        return ReturnModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReturnModelsTable::configure($table);
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
            'index' => ListReturnModels::route('/'),
            'create' => CreateReturnModel::route('/create'),
        ];
    }
}
