<?php

namespace App\Filament\Resources\GuarnicaoResource\Pages;

use App\Filament\Resources\GuarnicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuarnicao extends EditRecord
{
    protected static string $resource = GuarnicaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
