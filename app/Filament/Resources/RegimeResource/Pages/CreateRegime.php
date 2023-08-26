<?php

namespace App\Filament\Resources\RegimeResource\Pages;

use App\Filament\Resources\RegimeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRegime extends CreateRecord
{
    protected static string $resource = RegimeResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
