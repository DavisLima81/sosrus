<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;


class CalendarioWidget extends FullCalendarWidget
{
    //protected static string $view = 'filament.widgets.calendario-widget';
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // This method should return an array of event-like objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#returning-events
        // You can also return an array of EventData objects. See: https://github.com/saade/filament-fullcalendar/blob/3.x/#the-eventdata-class
        return [
            [
                'id' => 1,
                'title' => 'DVS',
                'start' => '2023-11-01 12:00:00',
                'end' => '2021-11-01 13:00:00',
                'url' => 'https://google.com',
                'backgroundColor' => 'red',
                'borderColor' => 'red',
                'textColor' => 'white',
            ],
            [
                'id' => 2,
                'title' => 'HTR',
                'start' => '2023-11-02 12:00:00',
                'end' => '2021-11-02 13:00:00',
                'url' => 'https://google.com',
                'backgroundColor' => 'blue',
                'borderColor' => 'blue',
                'textColor' => 'white',
            ],
        ];
    }

}
