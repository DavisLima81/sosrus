<?php

namespace App\Filament\Resources\EscaladoResource\Pages;

use App\Filament\Resources\EscaladoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewEscalado extends ViewRecord
{
    protected static string $resource = EscaladoResource::class;

    protected static string $view = 'filament.resources.escalados.pages.view-escalado';

    protected ?string $heading = 'Detalhe do Escalado';


}
