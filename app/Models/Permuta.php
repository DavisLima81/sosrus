<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\AntecedenciaPermuta;

class Permuta extends Model
{
    /*
     * @propertyRead string $entra_efetivo_trigrama
     * @propertyRead string $sai_efetivo_trigrama
     * */

    use HasFactory;

    protected $table = 'permutas';

    protected $fillable = [
        'escala_id',
        'data',
        'entra_efetivo_id',
        'sai_efetivo_id',
        'no_prazo',
        'autorizador_id',
        'created_at',
        'updated_at',
    ];

    public function escala() : BelongsTo
    {
        return $this->belongsTo(Escala::class, 'escala_id');
    }

    public function entra_efetivo() : BelongsTo
    {
        return $this->belongsTo(Efetivo::class, 'entra_efetivo_id');
    }

    public function sai_efetivo() : BelongsTo
    {
        return $this->belongsTo(Efetivo::class, 'sai_efetivo_id');
    }

    public function autorizador() : BelongsTo
    {
        return $this->belongsTo(Efetivo::class, 'autorizador_id');
    }

    //verifica se a permuta está dentro do prazo determinado por AntecedenciaPermuta
    public function noPrazo() : bool
    {
        $antecedencia = AntecedenciaPermuta::last();
        $horas = $antecedencia->horas_antecedencia;
        $data = $this->escala->inicio;
        $data->addHours($horas);
        return now() < $data;
    }

    //verifica se o sai_efetivo_id esta instanciado em escalado nesta data
    public function escalado() : bool
    {
        $escala = Escala::find($this->escala_id);
        $data = $this->data;
        $sai_efetivo_id = $this->sai_efetivo_id;
        $escalado = Escalado::where('escala_id', $escala->id)
            ->where('data', $data)
            ->where('efetivo_id', $sai_efetivo_id)
            ->first();
        return $escalado != null;
    }

    public function saiEfetivoTrigrama() : string
    {
        $sai_efetivo = Efetivo::find($this->sai_efetivo_id);
        return $sai_efetivo->trigrama;
    }

    public function entraEfetivoTrigrama() : string
    {
        $entra_efetivo = Efetivo::find($this->entra_efetivo_id);
        return $entra_efetivo->trigrama;
    }
}
