<?php

namespace App\Filament\Resources\ReturnModels\Pages;

use App\Filament\Resources\ReturnModels\ReturnModelResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateReturnModel extends CreateRecord
{
    protected static string $resource = ReturnModelResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        return $data;
    }
}
