<?php

namespace App\Livewire\Old;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;


/**
 * @property $mes
 * @property $ano
 * @property $anos
 * @property $sar
 * @property-read $calculaAnos
 * */
class Teste extends Component
{
    public ?string $mes;
    public ?string $ano;
    public ?string $sar;
    public string $texto;
    public ?Collection $anos;

    public function calculaAnos() : Collection
    {
        $anos = new Collection();
        $anos->push(date('Y'));

        if (date('m') > 8) {
            $anos->push(strval( date('Y') + 1));
        }
        return $this->anos = $anos;
    }

    public function mount()
    {
        $this->mes = 'MES MOUNT';
        $this->anos = $this->calculaAnos();
        $this->ano = '9999';
        $this->texto = 'TEXTO_MOUNT';
    }

    public function render()
    {
        return view('livewire.teste', [
            'anos' => $this->anos,

        ]);
    }
}
