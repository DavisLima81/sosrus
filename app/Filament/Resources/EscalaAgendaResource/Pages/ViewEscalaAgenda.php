<?php

namespace App\Filament\Resources\EscalaAgendaResource\Pages;

use App\Filament\Resources\EscalaAgendaResource;
use Filament\Resources\Pages\Page;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class ViewEscalaAgenda extends Page
{
    use HasPageShield;

    protected static string $resource = EscalaAgendaResource::class;

    protected static $can = ['viewAny', 'create', 'update', 'delete'];

    protected static string $view = 'filament.resources.escala-agenda-resource.pages.view-escala-agenda';
}
