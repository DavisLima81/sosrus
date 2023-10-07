<?php

namespace App\Filament\Resources\PermutaResource\Pages;

use App\Filament\Resources\PermutaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermuta extends CreateRecord
{
    protected static string $resource = PermutaResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
