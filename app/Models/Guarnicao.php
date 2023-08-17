<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guarnicao extends Model
{
    use HasFactory;

    protected $table = 'guarnicoes';

    protected $fillable = [
        'sigla',
        'nome',
        'descricao',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //region SETTERS
    public function setSiglaAttribute($value)
    {
        $this->attributes['sigla'] = mb_strtoupper($value);
    }
    //endregion

    public function escalas(): HasMany
    {
        return $this->hasMany(Escala::class, 'guarnicao_id');
    }
}
