<?php

namespace App\Filament\Resources\AdmFormResource\Pages;

use App\Filament\Resources\AdmFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdmForm extends EditRecord
{
    protected static string $resource = AdmFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
