<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\IcalendarGenerator\Components\Calendar as Icalendar;
use Spatie\IcalendarGenerator\Components\Event as Ievent;
use Spatie\GoogleCalendar\GoogleCalendar as Gcalendar;

class EscalaCalendario extends Model
{
    use HasFactory;

    protected $table = 'escala_calendarios';

    protected $fillable = [
        'escala_id',
    ];
}
