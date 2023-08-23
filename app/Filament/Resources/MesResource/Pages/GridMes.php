<?php

namespace App\Filament\Resources\MesResource\Pages;

use App\Filament\Resources\MesResource;
use Filament\Resources\Pages\Page;
use App\Models\Mes;

class GridMes extends Page
{
    protected static string $resource = MesResource::class;

    protected static string $view = 'filament.resources.mes-resource.pages.grid-mes';

    protected static ?string $title = 'Grade';

    protected ?string $heading = 'Mês em grade';
}
