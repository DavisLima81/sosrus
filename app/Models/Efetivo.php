<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Efetivo extends Model
{
    use HasFactory;

    protected $table = 'efetivos';

    protected $fillable = [
        'nome',
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
        'foto',
        'created_at',
        'updated_at',
    ];

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

}
