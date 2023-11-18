<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

use App\Models\Escala;
use App\Models\Mes;
use App\Models\DoAnoMes;

class ListEscalaAgenda extends Component
{
    public ?string $escala = null;
    public ?string $do_ano_mes = null;
    public string|array|null $ano = null;

    public function getEscalas()
    {
        $escalas = Escala::all()->where('ativo', true);
        return $this->escalas = $escalas;
    }

    public function getMeses()
    {
        $meses = Mes::all();
        return $this->meses = $meses;
    }

    public function getDoAnoMeses()
    {
        $doAnoMeses = DoAnoMes::all();
        return $this->doAnoMeses = $doAnoMeses;
    }

    public function getAnos()
    {
        $currentYear = date('Y');
        if (date('m') == 10 || date('m') == 11 || date('m') == 12) {
            $nextYear = strval(date('Y') + 1);
            $anos = array($currentYear, $nextYear);
        } else {
            $anos = array($currentYear);
        }
        return $this->anos = $anos;
    }

    public function getCelulasCalendario($mes): array
    {
        $numero_dias = $mes->numeroDias();
        $mes_primeiro_dia_semana = $mes->getMes()->startOfMonth()->dayOfWeek;
        //TODO: implementar os eventos/dias da escala
        //$feriados =  $mes->getFeriados()->get();
        $apoio = $numero_dias + $mes_primeiro_dia_semana;
        $cell[] = null;
        //dd($apoio, $mes_primeiro_dia_semana, $numero_dias);

        if($mes_primeiro_dia_semana > 1) {
            for ($i = 0; $i <= $apoio; $i++) {
                if ($i < $mes_primeiro_dia_semana) {
                    $cell[$i] = '--';
                } elseif ($i >= $mes_primeiro_dia_semana && $i <= $numero_dias + 1) {
                    $cell[$i - 1] = $i - $mes_primeiro_dia_semana + 1;
                } elseif ($i > $numero_dias - 1) {
                    $cell[$i - 2] = $i - $mes_primeiro_dia_semana;
                }
            }
            if ($feriados->count() > 0) {
                foreach ($feriados as $feriado) {
                    $dia_feriado = substr($feriado->data, -2);
                    $ref_cell = $dia_feriado + $mes_primeiro_dia_semana - 2;
                    $cell[$ref_cell] = array([$cell[$ref_cell], $feriado->nome]);
                }
            }
        } elseif($mes_primeiro_dia_semana == 1) {
            for ($i = 0; $i <= $apoio - 1; $i++) {
                if ($i < $mes_primeiro_dia_semana) {
                    $cell[$i] = '--';
                } elseif ($i >= $mes_primeiro_dia_semana && $i <= $numero_dias + 1) {
                    $cell[$i - 1] = $i - $mes_primeiro_dia_semana + 1;
                } elseif ($i > $numero_dias - 1) {
                    $cell[$i - 2] = $i - $mes_primeiro_dia_semana;
                }
            }
            if ($feriados->count() > 0) {
                foreach ($feriados as $feriado) {
                    $dia_feriado = substr($feriado->data, -2);
                    $ref_cell = $dia_feriado + $mes_primeiro_dia_semana - 2;
                    $cell[$ref_cell] = array([$cell[$ref_cell], $feriado->nome]);
                }
            }
        }
        elseif($apoio == $numero_dias) {
            for($i = -5; $i <= $apoio + 1; $i++){
                if ($i <= 1) {
                    $cell[$i] = '--';
                }
                elseif ($i > 0 && $i <= $apoio) {
                    $cell[$i - 1] = $i - 1;
                }
                elseif ($i >= $apoio) {
                    $cell[$i] = $i - 1;
                }
            }
            if ($feriados->count() > 0) {
                foreach ($feriados as $feriado) {
                    $dia_feriado = substr($feriado->data, -2);
                    $ref_cell = $dia_feriado + $mes_primeiro_dia_semana;
                    $cell[$ref_cell] = array([$cell[$ref_cell], $feriado->nome]);
                }
            }
        }
        //dd($cell);
        return $cell;
    }

    public function mount()
    {

    }

    public function render()
    {
        $escalas = $this->getEscalas();
        $do_ano_meses = $this->getDoAnoMeses();
        $anos = $this->getAnos();

        return view('livewire.list-escala-agenda', compact(
            'escalas',
            'do_ano_meses',
            'anos'

        ));
    }

    public function click(Request $request)
    {
        $ano = $this->ano;
        $do_ano_mes = $this->do_ano_mes;
        $escala = $this->escala;
        $mes = Mes::where('do_ano_mes_id', $do_ano_mes)->where('ano', $ano)->first();
        $escala = Escala::where('id', $escala)->first();

        //TODO: implementar lógica e comportamento se não encontrar o mes
        /*if(!$mes){
            throw new \Exception('Mes não encontrado');
        }*/

        $mes_nome = $mes->getMesNome();
        $mes_primeiro_dia = $mes->getMes()->startOfMonth();
        $mes_primeiro_dia_semana = $mes->getMes()->startOfMonth()->dayOfWeek;
        $mes_primeiro_dia_semana_nome = $mes->getMes()->startOfMonth()->locale('pt_BR')->dayName;
        $mes_ultimo_dia = $mes->getMes()->endOfMonth();
        $cell = $this->getCelulasCalendario($mes);

        //TODO: implementar a lógica para determinar os eventos do calendario




        dd(
            $mes_primeiro_dia_semana_nome,
            $mes_ultimo_dia,
            $cell
        );
        //TODO: construir os dados para renderizar o calendario

        //TODO: chamar método render com a view do calendario
        //return view('filament.resources.escala-agenda-resource.pages.view-escala-agenda',
        //    compact('escala', 'do_ano_mes', 'ano', 'mes'));


        /////////////// EXEMPLO DA OUTRA VIEW CALENDARIO ///////////////////////
        /// return view('livewire.mes-calendario',
        //            compact(
        //                'ano',
        //                'mes_nome',
        //                'mes_primeiro_dia',
        //                'mes_primeiro_dia_semana',
        //                'mes_primeiro_dia_semana_nome',
        //                'mes_ultimo_dia',
        //                'feriados',
        //                'cell'
        //            ));
    }

}
