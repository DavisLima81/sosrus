<?php

namespace App\Filament\Resources\MeuServicoResource\Pages;

use App\Filament\Resources\MeuServicoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMeuServicos extends ListRecords
{
    protected static string $resource = MeuServicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
