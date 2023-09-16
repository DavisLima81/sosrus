<?php

namespace App\Livewire\Old;

use App\Livewire\On;
use Carbon\Carbon;
use Livewire\Component;

/**
 *@property Carbon $mes_teste
 * @property $mes
 * @property $ano
 * */
class Caledario extends Component
{
    public ?string $mes = 'MES_MOUNT_CALENDAR';

    public function mount()
    {
        $this->mes = 'MES_MOUNT_CALENDAR';
    }

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
        $mes = $this->mes;
        return view('livewire.caledario', [
            'mes' => $mes,
        ]);
    }

    #[On('evento')]
    public function OnMes()
    {
        dd('Retetetete');
    }

}
