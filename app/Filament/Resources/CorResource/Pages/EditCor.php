<?php

namespace App\Filament\Resources\CorResource\Pages;

use App\Filament\Resources\CorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCor extends EditRecord
{
    protected static string $resource = CorResource::class;

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
