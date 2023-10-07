<?php

namespace App\Filament\Resources\PermutaResource\Pages;

use App\Filament\Resources\PermutaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermuta extends EditRecord
{
    protected static string $resource = PermutaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    //Redirect to index after update
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
