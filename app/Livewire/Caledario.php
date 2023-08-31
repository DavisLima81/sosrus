<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

/**
 *@property Carbon $mes_teste
 * */
class Caledario extends Component
{
    public function MesTeste() : array
    {
        $dt = Carbon::now();
        //criar um mes_teste com Carbon
        //obter colecao de dias do mes_teste
        $mes_teste = [
            $dt->year,
            $dt->month,
            $dt->day,
            $dt->hour,
            $dt->second,
            $dt->dayOfWeek,
            $dt->dayOfYear,
            $dt->weekOfMonth,
            $dt->daysInMonth,
        ];
        $this->mes_teste = $mes_teste;
        return $this->mes_teste;
    }

    public function render()
    {
        return view('livewire.caledario', [
            'mes_teste' => $this->MesTeste(),
        ]);
    }


}
