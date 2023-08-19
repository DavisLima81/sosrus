<?php

namespace App\Filament\Resources\MesResource\Pages;

use App\Filament\Resources\MesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMes extends ListRecords
{
    protected static string $resource = MesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
