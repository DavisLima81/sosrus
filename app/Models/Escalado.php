<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Escalado extends Model
{
    /*
     * @property protected $table
     * @property protected $fillable
     * @propertyRead string $efetivo_trig
     * @propertyRead array $get_permutas
     *
     *
    */

    use HasFactory;

    protected $table = 'escalados';

    protected $fillable = [
        'escala_id',
        'efetivo_id', //id do efetivo/pessoa escalada
        'data',
        'created_at',
        'updated_at',
    ];

    public function getEscaladoDia() {
        $escalado_dia = new Carbon($this->data);
        return $escalado_dia->format('d/m/Y');
    }


    public function escala() : BelongsTo
    {
        return $this->belongsTo(Escala::class, 'escala_id');
    }

    public function efetivo() : BelongsTo
    {
        return $this->belongsTo(Efetivo::class, 'efetivo_id');
    }

    //verifica se existem permutas para este Escalado
    public function getPermutas() : Collection
    {
        $get_permutas = Permuta::where('escala_id', $this->escala_id)
            ->where('data', $this->data)
            ->get();
        return $get_permutas;
    }

    public function getEfetivoTrig() : string
    {
        return $this->efetivo->trigrama;
    }

    //verifica se existe permuta
    public function temPermuta() : bool
    {
        if ($this->getPermutas()->count() > 0) {
            $tem_permuta = true;
            return $tem_permuta;
        }
        $tem_permuta = false;
        return $tem_permuta;
    }

    //se ohuver permuta, retorna o trigrama do efetivo da última permuta
    public function getTrigramaPermuta() : string
    {
        if ($this->temPermuta()) {
            return $this->getPermutas()->last()->entra_efetivo->trigrama;
        }
        return 'N/A';
    }

    public function efetivo_trig() : string
    {
        if($this->temPermuta())
        {
            return $this->getTrigramaPermuta();
        }
        return $this->efetivo->trigrama;
    }
}

