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
        $mes = $this->mes;
        $mes_nome = $mes->locale('pt_BR')->monthName;
        $mes_nome = mb_strtoupper($mes_nome);
        return $this->mes_nome = $mes_nome;
    }

    public function getFeriados(): Builder
    {
        $mes = $this->mes;
        $ano = $mes->year;
        $mes = $mes->month;
        $feriados = Feriado::where('data', 'like', $ano . '%' . $mes . '%');
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

    public function render()
    {
        $numero_dias = $this->getDoAnoMes()->numeroDias();
        $mes_nome = $this->getMesNome();
        $mes_primeiro_dia = $this->getMes()->startOfMonth();
        $mes_primeiro_dia_semana = $this->getMes()->startOfMonth()->dayOfWeek;
        $mes_primeiro_dia_semana_nome = $this->nomeDiaSemana($this->getMes()->startOfMonth()->dayOfWeek);
        $mes_ultimo_dia = $this->getMes()->endOfMonth();
        $feriados = $this->getFeriados()->get();
        $cell[] = null;

        //criar um stdClass para cada dia do mes a partir do loop ate o ultimo dia do mes
        /*
        for($i = 0; $i <= $numero_dias; $i++){
            $cell[$i] = new \stdClass();
            $cell[$i]->dia = $i;
            $cell[$i]->dia_semana = $this->nomeDiaSemana($this->getMes()->startOfMonth()->dayOfWeek);
            $cell[$i]->feriado = false;
            $cell[$i]->feriado_nome = null;
            $cell[$i]->feriado_id = null;
            $cell[$i]->feriado_data = null;
            $cell[$i]->feriado_dia = null;
            $cell[$i]->feriado_mes = null;
            $cell[$i]->feriado_ano = null;
            $cell[$i]->feriado_dia_semana;
        }
        */
        return view('livewire.mes-calendario',
            compact(
            'mes_nome',
            'mes_primeiro_dia',
            'mes_primeiro_dia_semana',
            'mes_primeiro_dia_semana_nome',
            'mes_ultimo_dia',
            'feriados'

            ));
    }

    #[On('evento')]
    public function OnMes()
    {
        dd('Retetetete');
    }

}
