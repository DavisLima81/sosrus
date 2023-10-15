<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Escala extends Model
{
    use HasFactory;

    protected $table = 'escalas';

    protected $fillable = [
        'escala_tipo_id',
        'guarnicao_id',
        'nome',
        'descricao',
        'inicio',
        'duracao',
        'regime_id',
        'ativo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //region SETTERS
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = mb_strtoupper($value);
    }
    //endregion

    public function escala_tipo(): BelongsTo
    {
        return $this->belongsTo(EscalaTipo::class, 'escala_tipo_id');
    }

    public function guarnicao(): BelongsTo
    {
        return $this->belongsTo(Guarnicao::class, 'guarnicao_id');
    }

    public function regime(): BelongsTo
    {
        return $this->belongsTo(Regime::class, 'regime_id');
    }

    public function efetivos(): BelongsToMany
    {
        return $this->belongsToMany(Efetivo::class, 'efetivos_escalas', 'escala_id', 'efetivo_id');
    }

    public function agenda() : HasOne
    {
        return $this->hasOne(Agenda::class, 'escala_id', 'id');
    }
}
