<?php

namespace App\Filament\Resources\EfetivoResource\Pages;

use App\Filament\Resources\EfetivoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEfetivos extends ListRecords
{
    protected static string $resource = EfetivoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
