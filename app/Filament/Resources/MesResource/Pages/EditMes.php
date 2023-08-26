<?php

namespace App\Filament\Resources\MesResource\Pages;

use App\Filament\Resources\MesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMes extends EditRecord
{
    protected static string $resource = MesResource::class;

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
