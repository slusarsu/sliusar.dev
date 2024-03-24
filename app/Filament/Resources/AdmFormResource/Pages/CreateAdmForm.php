<?php

namespace App\Filament\Resources\AdmFormResource\Pages;

use App\Filament\Resources\AdmFormResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmForm extends CreateRecord
{
    protected static string $resource = AdmFormResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
