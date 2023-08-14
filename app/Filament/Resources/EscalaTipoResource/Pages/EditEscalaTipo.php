<?php

namespace App\Filament\Resources\EscalaTipoResource\Pages;

use App\Filament\Resources\EscalaTipoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEscalaTipo extends EditRecord
{
    protected static string $resource = EscalaTipoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
