<?php

namespace App\Filament\Resources\ReturnModels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Auth;

class ReturnModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // \Filament\Forms\Components\Placeholder::make('debug_role')
                //     ->label('Role saat ini')
                //     ->content(fn() => Auth::user()?->roles->pluck('name')->join(', ') ?? 'tidak ada'),

                // USER & ADMIN
                Select::make('order_item_id')
                    ->label('Order Item')
                    ->relationship('orderItem', 'product_name')
                    ->required(),

                // ADMIN ONLY
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->visible(fn() => Auth::check() && Auth::user()->roles->contains('name', 'super_admin')),

                // USER & ADMIN
                Textarea::make('reason')
                    ->label('Reason')
                    ->required(),

                // USER & ADMIN
                FileUpload::make('image')
                    ->label('Bukti')
                    ->image()
                    ->directory('returns'),

                // ADMIN ONLY
                Textarea::make('admin_note')
                    ->label('Admin Note')
                    ->visible(fn() => Auth::check() && Auth::user()->roles->contains('name', 'super_admin')),

            ]);
    }
}
