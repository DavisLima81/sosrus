<?php

namespace App\Filament\Resources\EscalaAgendaResource\Pages;

use App\Filament\Resources\EscalaAgendaResource;
use Filament\Resources\Pages\Page;

class ViewEscalaAgenda extends Page
{
    protected static string $resource = EscalaAgendaResource::class;

    protected static string $view = 'filament.resources.escala-agenda-resource.pages.view-escala-agenda';
}
