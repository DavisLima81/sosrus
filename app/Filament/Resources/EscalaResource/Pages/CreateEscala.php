<?php

namespace App\Filament\Resources\EscalaResource\Pages;

use App\Filament\Resources\EscalaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEscala extends CreateRecord
{
    protected static string $resource = EscalaResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
