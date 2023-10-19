<?php

namespace App\Filament\Resources\MeuServicoResource\Pages;

use App\Filament\Resources\MeuServicoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMeuServico extends EditRecord
{
    protected static string $resource = MeuServicoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
