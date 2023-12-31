<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Efetivo extends Model
{
    use HasFactory;

    protected $table = 'efetivos';

    protected $fillable = [
        'nome',
        'rg',
        'nome_guerra',
        'trigrama',
        'precedencia_id',
        'quadro_id',
        'especialidade_id',
        'subunidade_id',
        'secao_id',
        'funcao_id',
        'status_id',
        'data_nascimento',
        'user_id',
        'foto',
        'created_at',
        'updated_at',
    ];

    //region RELATIONSHIPS
    public function quadro(): BelongsTo
    {
        return $this->belongsTo(Quadro::class);
    }

    public function especialidade(): BelongsTo
    {
        return $this->belongsTo(Especialidade::class);
    }

    public function subunidade(): BelongsTo
    {
        return $this->belongsTo(Subunidade::class);
    }

    public function secao(): BelongsTo
    {
        return $this->belongsTo(Secao::class);
    }

    public function funcao(): BelongsTo
    {
        return $this->belongsTo(Funcao::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function precedencia(): BelongsTo
    {
        return $this->belongsTo(Precedencia::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function escalas(): BelongsToMany
    {
        return $this->belongsToMany(Escala::class, 'efetivos_escalas', 'efetivo_id', 'escala_id')
            ->withTimestamps();
    }

    public function getTrigrama() : string {
        return $this->trigrama;
    }

    //endregion

    //region SETTERS
    public function setTrigramaAttribute($value)
    {
        $this->attributes['trigrama'] = mb_strtoupper($value);
    }
    //endregion
}
