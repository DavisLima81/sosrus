<?php

namespace App\Livewire;

use App\Models\Mes;
use Carbon\Carbon;
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

    public function getMesNome(): string
    {
        $mes = $this->mes;
        $mes_nome = $mes->locale('pt_BR')->monthName;
        $mes_nome = mb_strtoupper($mes_nome);
        return $this->mes_nome = $mes_nome;
    }

    public function getFeriados(): array
    {
        $mes = $this->mes;
        $feriados = $mes->holidays();
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
        $mes_nome = $this->getMesNome();
        $mes_primeiro_dia = $this->getMes()->startOfMonth();
        $mes_primeiro_dia_semana = $this->getMes()->startOfMonth()->dayOfWeek;
        $mes_primeiro_dia_semana_nome = $this->nomeDiaSemana($this->getMes()->startOfMonth()->dayOfWeek);

        $mes_ultimo_dia = $this->getMes()->endOfMonth();

        return view('livewire.mes-calendario',
            compact(
            'mes_nome',
            'mes_primeiro_dia',
            'mes_primeiro_dia_semana',
            'mes_primeiro_dia_semana_nome',
            'mes_ultimo_dia'
            ));
    }

    #[On('evento')]
    public function OnMes()
    {
        dd('Retetetete');
    }

}
