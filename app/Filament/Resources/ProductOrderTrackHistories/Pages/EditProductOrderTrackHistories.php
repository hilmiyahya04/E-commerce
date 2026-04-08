<?php

namespace App\Filament\Resources\ProductOrderTrackHistories\Pages;

use App\Filament\Resources\ProductOrderTrackHistories\ProductOrderTrackHistoriesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductOrderTrackHistories extends EditRecord
{
    protected static string $resource = ProductOrderTrackHistoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
