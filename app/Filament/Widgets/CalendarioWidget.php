<?php

namespace App\Filament\Widgets;

use App\Models\MeuServico;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;



class CalendarioWidget extends FullCalendarWidget
{
    //protected static string $view = 'filament.widgets.calendario-widget';
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function __construct()
    {
        $this->events = new MeuServico();
        return $this->events->meu_servicos;
    }


    public function fetchEvents(array $fetchInfo): array
    {
        $aa = $this->events->meu_servicos;
        //dd($aa);
        return $aa;
    }

}
