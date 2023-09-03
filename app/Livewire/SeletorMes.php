<?php

namespace App\Livewire;

use App\Models\Mes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property $mes
 * @property $ano
 * @property $anos
 * @property $meses
 * @property $selectedano
 * @property $count
 */

class SeletorMes extends Component
{
    public ?string $selectedano;
    public ?Collection $meses;
    public ?string $mes;
    public ?string $ano;
    public $anos;


    public function mount(Request $request)
    {
        $this->selectedano = null;
        $this->meses = null;
        $this->mes = 'MES INICIAL MOUNT';
        $this->ano = '';
        $this->anos = Mes::select('ano')->distinct()->get();
    }

    public function render()
    {
        return view('livewire.seletor-mes', [
            'anos' => $this->anos,
            'meses' => $this->meses,
            'mes' => $this->selecionouMes(),
        ]);
    }

    public function updated($ano)
    {
        dd($this->ano);
        /*if ($this->selectedano != null) {
            $this->meses = Mes::where('ano', $this->selectedano)->get();
            return $this->meses;
        } else {
            return null;
        }*/
    }

    //chamar funçao updated meses

    public function selecionouMes() : string
    {
        $mes = $this->mes;
        //enviar o valor do mes para o componente calendario
        return $mes;
    }
}
