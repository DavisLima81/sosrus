<?php

namespace App\Filament\Resources\EscaladoResource\Pages;

use App\Filament\Resources\EscaladoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEscalado extends CreateRecord
{
    protected static string $resource = EscaladoResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
