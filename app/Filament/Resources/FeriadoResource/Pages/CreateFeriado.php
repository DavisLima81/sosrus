<?php

namespace App\Filament\Resources\FeriadoResource\Pages;

use App\Filament\Resources\FeriadoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeriado extends CreateRecord
{
    protected static string $resource = FeriadoResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
