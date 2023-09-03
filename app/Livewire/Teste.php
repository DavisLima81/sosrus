<?php

namespace App\Livewire;

use App\Models\Mes;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


/**
 * @property $mes
 * @property $ano
 * @property $anos
 * */
class Teste extends Component
{
    public ?string $mes;
    public ?string $ano;
    public ?Collection $anos;

    public function mount()
    {
        $this->mes = 'MES MOUNT';
        $this->anos = Mes::select('ano')->distinct()->get();
        $this->ano = '';
    }

    public function render()
    {
        return view('livewire.teste', [
            'anos' => $this->anos,
        ]);
    }

    public function selecionouAno($ano)
    {
        $this->ano = $ano;
        dd('lkasjd');
    }
}
