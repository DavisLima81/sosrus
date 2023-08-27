<?php

namespace App\Filament\Resources\CorResource\Pages;

use App\Filament\Resources\CorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCor extends CreateRecord
{
    protected static string $resource = CorResource::class;

    //Redirect to index after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
