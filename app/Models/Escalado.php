<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Escalado extends Model
{
    use HasFactory;

    protected $table = 'escalados';

    protected $fillable = [
        'escala_id',
        'efetivo_id', //id do efetivo/pessoa escalada
        'data',
        'created_at',
        'updated_at',
    ];

    public function escala() : BelongsTo
    {
        return $this->belongsTo(Escala::class, 'escala_id');
    }

    public function efetivo() : BelongsTo
    {
        return $this->belongsTo(Efetivo::class, 'efetivo_id');
    }

    //verifica se existem permutas para este Escalado
    public function permuta() : Collection
    {
        $permuta = Permuta::where('sai_efetivo_id', $this->efetivo_id)
            ->where('data', $this->data)
            ->get();
        return $permuta;
    }

    //verifica se existe permuta
    public function temPermuta() : bool
    {
        if ($this->permuta()->count() > 0) {
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
            return $this->permuta()->last()->entra_efetivo->trigrama;
        }
        return 'N/A';
    }
}

