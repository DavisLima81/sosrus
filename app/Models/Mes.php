<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Request;

/**
 * @property int $do_ano_mes_id
 * @property int $ano
 * @property int $created_at
 * @property int $updated_at
 * @property int $id
 * @property int $numero_dias
 * @property int $numero_dias_uteis
 * @property int $primeiro_dia_semana
 * @property int $numero_feriados
 * @property int $numero_feriados_uteis
 * @property int $numero_dias_fdsmn
 * @property int $numero_dias_nao_uteis
 */
class Mes extends Model
{
    use HasFactory;

    protected $table = 'meses';

    protected $fillable = [
        'ano',
        'do_ano_mes_id',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [
        ])
    {
        parent::__construct($attributes);
    }

    //calcular numero de dias do mes
    public function numeroDias() : int
    {
        $do_ano_mes_id = $this->do_ano_mes_id;
        $ano = $this->ano;
        $numero_dias = cal_days_in_month(CAL_GREGORIAN, $do_ano_mes_id, $ano);
        return $this->numero_dias = $numero_dias;
    }

    public function getMes(): Carbon
    {
        $mes = Carbon::createFromFormat('Y-m-d', "{$this->ano}-{$this->do_ano_mes_id}-01");
        return $this->mes = $mes;
    }

    //calcular numero de feriados
    public function numeroFeriados() : int
    {
        $do_ano_mes_id = $this->do_ano_mes_id;
        $do_ano_mes_id = str_pad($do_ano_mes_id, 2, "0", STR_PAD_LEFT);
        $ano = $this->ano;
        $numero_feriados = Feriado::where('data', 'like', $ano . '-' . $do_ano_mes_id . '%')->count();
        return $this->numero_feriados = $numero_feriados;
    }

    //calcular numero de feriados em dias que seriam uteis
    public function numeroFeriadosUteis() : int
    {
        $ano = $this->ano;
        $do_ano_mes_id = $this->do_ano_mes_id;
        $do_ano_mes_id = str_pad($do_ano_mes_id, 2, "0", STR_PAD_LEFT);
        $numero_feriados_uteis = 0;
        $feriados = Feriado::where('data', 'like', $ano . '-' . $do_ano_mes_id . '%')->get();
        foreach ($feriados as $feriado) {
            $dia_semana = date('w', strtotime($feriado->data));
            if ($dia_semana != 0 && $dia_semana != 6) {
                $numero_feriados_uteis++;
            }
        }
        return $numero_feriados_uteis;
    }

    //calcular numero de dias uteis do mes
    public function numeroDiasUteis() : int
    {
        $numero_dias = $this->numeroDias();
        $numero_dias_uteis = 0;
        $ano = $this->ano;
        $do_ano_mes_id = $this->do_ano_mes_id;
        $numero_feriados_uteis = $this->numeroFeriadosUteis();

        for ($i = 1; $i <= $numero_dias; $i++) {
            $dia_semana = date('w', strtotime($ano . '-' . $do_ano_mes_id . '-' . $i));
            if ($dia_semana != 0 && $dia_semana != 6) {
                $numero_dias_uteis++;
            }
        }
        $numero_dias_uteis = $numero_dias_uteis - $numero_feriados_uteis;
        return $numero_dias_uteis;
    }

    //calcular numero de dias de fim de semana (sabado e domingo) do mes
    public function numeroDiasFdsmn() : int
    {
        $numero_dias = $this->numeroDias();
        $numero_dias_fdsmn = 0;
        $ano = $this->ano;
        $do_ano_mes_id = $this->do_ano_mes_id;

        for ($i = 1; $i <= $numero_dias; $i++) {
            $dia_semana = date('w', strtotime($ano . '-' . $do_ano_mes_id . '-' . $i));
            if ($dia_semana == 0 || $dia_semana == 6) {
                $numero_dias_fdsmn++;
            }
        }
        return $numero_dias_fdsmn;
    }

    //calcular numero de dias não uteis
    public function numeroDiasNaoUteis() : int
    {
        $numero_dias_fdsmn = $this->numeroDiasFdsmn();
        $numero_feriados_uteis = $this->numeroFeriadosUteis();
        $numero_dias_nao_uteis = $numero_dias_fdsmn + $numero_feriados_uteis;
        return $numero_dias_nao_uteis;
    }

    public function getMesNome(): string
    {
        $mes = $this->getMes();
        $mes_nome = $mes->locale('pt_BR')->monthName;
        $mes_nome = mb_strtoupper($mes_nome);
        return $this->mes_nome = $mes_nome;
    }

    //calcular primeiro dia da semana do mes
    public function primeiroDiaSemana() : int
    {
        $do_ano_mes_id = $this->do_ano_mes_id;
        $ano = $this->ano;
        $primeiro_dia_semana = date('w', strtotime($ano . '-' . $do_ano_mes_id . '-01'));
        return $primeiro_dia_semana;
    }
    //relacionamentos
    public function doAnoMeses() : BelongsTo
    {
        return $this->belongsTo(DoAnoMes::class, 'do_ano_mes_id');
    }

    public function feriados() : HasMany
    {
        return $this->HasMany(Feriado::class);
    }
}
