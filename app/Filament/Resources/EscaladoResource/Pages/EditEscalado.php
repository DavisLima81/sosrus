<?php

namespace App\Filament\Resources\EscaladoResource\Pages;

use App\Filament\Resources\EscaladoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEscalado extends EditRecord
{
    protected static string $resource = EscaladoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    //Redirect to index after update
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
