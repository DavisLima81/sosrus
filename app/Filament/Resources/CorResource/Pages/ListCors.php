<?php

namespace App\Filament\Resources\CorResource\Pages;

use App\Filament\Resources\CorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCors extends ListRecords
{
    protected static string $resource = CorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    //Redirect to index after update
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
