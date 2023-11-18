<?php

namespace App\Filament\Resources\EscalaAgendaResource\Pages;

use App\Filament\Resources\EscalaAgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEscalaAgenda extends EditRecord
{
    protected static string $resource = EscalaAgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
