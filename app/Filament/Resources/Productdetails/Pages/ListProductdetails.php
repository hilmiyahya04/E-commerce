<?php

namespace App\Filament\Resources\Productdetails\Pages;

use App\Filament\Resources\Productdetails\ProductdetailsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductdetails extends ListRecords
{
    protected static string $resource = ProductdetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
