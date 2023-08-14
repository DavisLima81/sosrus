<?php

namespace App\Filament\Resources\GuarnicaoResource\Pages;

use App\Filament\Resources\GuarnicaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuarnicaos extends ListRecords
{
    protected static string $resource = GuarnicaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
