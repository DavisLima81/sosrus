<?php

namespace App\Livewire\Old;

use App\Models\Mes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use function App\Livewire\mb_strtoupper;

/**
 * @property $mes
 * @property $ano
 * @property $anos
 * @property $meses
 * @property $selectedano
 * @property $count
 * @property-read $calculaAnos
 * $property-read $mes_instanciado
 */

class SeletorMes extends Component
{
    public ?string $selectedano;
    public ?Collection $meses;
    public ?string $mes;
    public ?string $ano;
    public $anos;
    public ?Mes $mes_instanciado;
    public ?string $mes_carbon;

    public function calculaAnos() : Collection
    {
        $anos = new Collection();
        $anos->push(date('Y'));

        if (date('m') > 8) {
            $anos->push(strval( date('Y') + 1));
        }
        return $this->anos = $anos;
    }

    public function mount(
        $selectedano = null,
        $meses = null,
        $mes = '',
        $ano = '',
        $anos = null,
        $mes_instanciado = null,
        $mes_carbon = ''
    )
    {
        $this->selectedano = $selectedano;
        $this->meses = $meses;
        $this->mes = $mes;
        $this->ano = $ano;
        $this->anos = $anos;
        $this->mes_instanciado = $mes_instanciado;
        $this->mes_carbon = $mes_carbon;
    }

    public function rendered()
    {
        $this->mes_instanciado = null;
    }

    public function render()
    {
        $this->dispatch('render-seletor-mes', mes: $this->mes);

        return view('livewire.seletor-mes', [
            'anos' => $this->calculaAnos(),
            'meses' => $this->meses,
            'mes' => $this->mes,
            'mes_instanciado' => $this->mesInstanciado(),
            'mes_carbon' => $this->mes_carbon,
        ]);
    }

    public function updatedAno($ano)
    {
        $this->meses = Mes::where('ano', $ano)->get();

    }

    public function selecionouMes()
    {
        return $this->mes;
    }

    public function mesInstanciado() : Mes
    {
        $mes_instanciado = new(Mes::class);
        $mes_instanciado->ano = $this->ano;
        $mes_instanciado->do_ano_mes_id = $this->mes;
        return $mes_instanciado;
    }

    //funcao para obter o nome do mes Carbon a partir de $mes_instanciado
    public function getMesCarbon($mes_instanciado) : string
    {
        dd($mes_instanciado);
        $mes_instanciado = $this->mesInstanciado();

        if ($mes_instanciado->do_ano_mes_id != '') {
            $mes_instanciado = $this->mesInstanciado();
            //obtem o nome do mês a partir de $mes_instanciado
            $nome_mes_carbon = Carbon::create($mes_instanciado->ano,
                $mes_instanciado->do_ano_mes_id,
                1, 0, 0, 0, env('TIMEZONE'))
                ->locale('pt_BR')->monthName;

            $mes_carbon = mb_strtoupper($nome_mes_carbon);
            $this->mes_carbon = $mes_carbon;
            return $mes_carbon;
        } else {
            return '';
        }
    }

    public function limpaCalendario() : string
    {
        $mes_instanciado = $this->mesInstanciado();
        if ($mes_instanciado->do_ano_mes_id != '') {
            $mes_instanciado->do_ano_mes_id = '';
            return $this->getMesCarbon();
        } else {
            return 'hidden';
        }
    }

    public function refresh()
    {
        return redirect()->url()->previous();
    }

}
