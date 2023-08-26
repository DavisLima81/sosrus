<?php

namespace App\Filament\Resources\EfetivoResource\Pages;

use App\Filament\Resources\EfetivoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEfetivo extends CreateRecord
{
    protected static string $resource = EfetivoResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
