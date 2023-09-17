<?php

namespace App\Filament\Resources\EscaladoResource\Pages;

use App\Filament\Resources\EscaladoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEscalados extends ListRecords
{
    protected static string $resource = EscaladoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
