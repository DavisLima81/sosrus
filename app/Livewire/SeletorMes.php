<?php

namespace App\Livewire;

use App\Models\Mes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 *
 */

class SeletorMes extends Component
{
    public $selectedano = null;
    public $meses = null;
    public $ano = '';
    public $count = 1;

    public function filtroAno($selectedano) : Collection | null
    {
            //dd($this->selectedano);
        if ($this->selectedano != null) {
            $this->meses = Mes::where('ano', $this->selectedano)->get();
            return $this->meses;
        } else {
            return null;
        }
    }

    public function render()
    {
        return view('livewire.seletor-mes', [
            'anos' => Mes::select('ano')->distinct()->get(),
            'meses' => Mes::all(),
        ]);
    }
}
