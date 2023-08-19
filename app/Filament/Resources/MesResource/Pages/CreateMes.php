<?php

namespace App\Filament\Resources\MesResource\Pages;

use App\Filament\Resources\MesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMes extends CreateRecord
{
    protected static string $resource = MesResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
