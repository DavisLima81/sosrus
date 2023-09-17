<?php

namespace App\Filament\Resources\PermutaResource\Pages;

use App\Filament\Resources\PermutaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermutas extends ListRecords
{
    protected static string $resource = PermutaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
