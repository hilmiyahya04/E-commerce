<?php

namespace App\Filament\Resources\Productdetails\Pages;

use App\Filament\Resources\Productdetails\ProductdetailsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductdetails extends EditRecord
{
    protected static string $resource = ProductdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
