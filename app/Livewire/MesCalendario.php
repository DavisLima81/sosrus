<?php

namespace App\Livewire;

use App\Models\Feriado;
use App\Models\Mes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class MesCalendario extends Component
{
    public ?string $mes_nome = 'MES_MOUNT_CALENDAR';
    public ?Carbon $mes = null;

    public function mount()
    {
        $this->mes_nome = 'MES_MOUNT_CALENDAR';
        $this->mes = $this->getMes();
        $this->mes_nome = $this->getMesNome();
    }

    public function getMes(): Carbon
    {
        $request = Request::route()->parameters();
        $do_ano_mes = Mes::find($request['record']);
        $mes = Carbon::createFromFormat('Y-m-d', "{$do_ano_mes->ano}-{$do_ano_mes->do_ano_mes_id}-01");
        return $this->mes = $mes;
    }

    public function getDoAnoMes(): Mes
    {
        $request = Request::route()->parameters();
        $do_ano_mes = Mes::find($request['record']);
        return $this->do_ano_mes = $do_ano_mes;
    }

    public function getMesNome(): string
    {
        $mes = $this->getMes();
        $mes_nome = $mes->locale('pt_BR')->monthName;
        $mes_nome = mb_strtoupper($mes_nome);
        return $this->mes_nome = $mes_nome;
    }

    public function getFeriados(): Builder
    {
        $mes = $this->getMes();
        $ano = $mes->year;
        $mes = $mes->month;
        //pegar os feriados onde a string data corresponde com o mes e ano
        $feriados = Feriado::where('data', 'like', $ano . '-' . $mes . '%');

        return $feriados;
    }

    public function nomeDiaSemana(int $dia_semana) : string
    {
        if ($dia_semana < 0 || $dia_semana > 6) {
            throw new \Exception('Dia da semana deve ser inteiro entre 0 e 6');
        }
        if ($dia_semana == 0) {
            return 'Domingo';
        }
        if ($dia_semana == 1) {
            return 'Segunda';
        }
        if ($dia_semana == 2) {
            return 'Terça';
        }
        if ($dia_semana == 3) {
            return 'Quarta';
        }
        if ($dia_semana == 4) {
            return 'Quinta';
        }
        if ($dia_semana == 5) {
            return 'Sexta';
        }
        if ($dia_semana == 6) {
            return 'Sábado';
        } else
            return 'Dia da semana não encontrado';
    }

    public function getCelulasCalendario(): array
    {
        $numero_dias = $this->getDoAnoMes()->numeroDias();
        $mes_primeiro_dia_semana = $this->getMes()->startOfMonth()->dayOfWeek;
        $feriados =  $this->getFeriados()->get();
        $apoio = $numero_dias + $mes_primeiro_dia_semana;
        $cell[] = null;
        //dd($apoio, $mes_primeiro_dia_semana, $numero_dias);

        if($apoio != $numero_dias){
            for($i = 0; $i <= $apoio; $i++){
                if ($i < $mes_primeiro_dia_semana) {
                    $cell[$i] = '--';
                }
                elseif ($i >= $mes_primeiro_dia_semana && $i <= $numero_dias + 1) {
                    $cell[$i - 1] = $i - $mes_primeiro_dia_semana + 1;
                }
                elseif ($i > $numero_dias - 1) {
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
        } else {
            for($i = -5; $i <= $apoio + 1; $i++){
                if ($i <= 1) {
                    $cell[$i] = '--';
                }
                elseif ($i > 0 && $i <= $numero_dias) {
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

    //TODO: AJUSTAR A FUNÇÃO RENDER PARA ENCAMINHAR OS DADOS ADEQUADOS PRA GERAR O CALENÁRIO
    public function render()
    {
        $numero_dias = $this->getDoAnoMes()->numeroDias();
        $mes_nome = $this->getMesNome();
        $mes_primeiro_dia = $this->getMes()->startOfMonth();
        $mes_primeiro_dia_semana = $this->getMes()->startOfMonth()->dayOfWeek;
        $mes_primeiro_dia_semana_nome = $this->nomeDiaSemana($this->getMes()->startOfMonth()->dayOfWeek);
        $mes_ultimo_dia = $this->getMes()->endOfMonth();
        $feriados = $this->getFeriados()->get();
        $cell = $this->getCelulasCalendario();

        return view('livewire.mes-calendario',
            compact(
            'mes_nome',
            'mes_primeiro_dia',
            'mes_primeiro_dia_semana',
            'mes_primeiro_dia_semana_nome',
            'mes_ultimo_dia',
            'feriados',
            'cell'
            ));
    }

    #[On('evento')]
    public function OnMes()
    {
        dd('Retetetete');
    }

}
