<?php

namespace App\Filament\Resources\MeuServicoResource\Pages;

use App\Filament\Resources\MeuServicoResource;
use Filament\Resources\Pages\Page;

class CalendarioMeuServicos extends Page
{
    protected static string $resource = MeuServicoResource::class;

    protected static string $view = 'filament.resources.meu-servico-resource.pages.calendario-meu-servicos';
}
