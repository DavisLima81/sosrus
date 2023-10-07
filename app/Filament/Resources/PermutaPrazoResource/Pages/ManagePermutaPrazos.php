<?php

namespace App\Filament\Resources\PermutaPrazoResource\Pages;

use App\Filament\Resources\PermutaPrazoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePermutaPrazos extends ManageRecords
{
    protected static string $resource = PermutaPrazoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
