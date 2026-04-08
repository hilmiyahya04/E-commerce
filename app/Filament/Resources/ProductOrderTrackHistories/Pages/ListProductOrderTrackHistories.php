<?php

namespace App\Filament\Resources\ProductOrderTrackHistories\Pages;

use App\Filament\Resources\ProductOrderTrackHistories\ProductOrderTrackHistoriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductOrderTrackHistories extends ListRecords
{
    protected static string $resource = ProductOrderTrackHistoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
