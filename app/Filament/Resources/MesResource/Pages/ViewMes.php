<?php

namespace App\Filament\Resources\MesResource\Pages;

use App\Filament\Resources\MesResource;
use Filament\Resources\Pages\Page;

class ViewMes extends Page
{
    protected static string $resource = MesResource::class;

    protected static string $view = 'filament.resources.mes-resource.pages.view-mes';

    protected ?string $heading = 'Detalhe do Mês';
}
