<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    //calcular numero de dias do mes
    public function numeroDias($ano, $numero) : int
    {
        return cal_days_in_month(CAL_GREGORIAN, $numero, $ano);
    }

    //calcular numero de dias uteis do mes
    public function numeroDiasUteis($ano, $numero) : int
    {
        $numeroDias = $this->numeroDias($ano, $numero);
        $numeroDiasUteis = 0;
        for ($i = 1; $i <= $numeroDias; $i++) {
            $diaSemana = date('w', strtotime($ano . '-' . $numero . '-' . $i));
            if ($diaSemana != 0 && $diaSemana != 6) {
                $numeroDiasUteis++;
            }
        }
        return $numeroDiasUteis;
    }

    //calcular primeiro dia da semana do mes
    public function primeiroDiaSemana($ano, $numero) : int
    {
        $diaSemana = date('w', strtotime($ano . '-' . $numero . '-01'));
        return $diaSemana;
    }
    //relacionamentos
    public function doAnoMeses() : BelongsTo
    {
        return $this->belongsTo(DoAnoMes::class, 'do_ano_mes_id');
    }
}
