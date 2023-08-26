<?php

namespace App\Filament\Resources\EscalaTipoResource\Pages;

use App\Filament\Resources\EscalaTipoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEscalaTipos extends ListRecords
{
    protected static string $resource = EscalaTipoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
