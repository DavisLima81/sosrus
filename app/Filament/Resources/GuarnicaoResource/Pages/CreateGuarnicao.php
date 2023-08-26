<?php

namespace App\Filament\Resources\GuarnicaoResource\Pages;

use App\Filament\Resources\GuarnicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuarnicao extends CreateRecord
{
    protected static string $resource = GuarnicaoResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
