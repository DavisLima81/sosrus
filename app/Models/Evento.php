<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'resumo',
        'descricao',
        'localizacao',
        'inicio',
        'fim',
        'frequentadores',
        'lembretes',
        'evento_tipo',
        'status',
        'agenda_id',
        'created',
        'updated',
        'cor_id',
        'criador_id',
        'organizador',
        'fim_indefinido',
        'recorrencia',
        'recorrencia_id',
        'transparencia',
        'visibilidade',
        'iCalUID',
        'sequencia',
        'frequentadores_omitidos',
    ];

    public function agenda() : BelongsTo
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }

    public function cor() : BelongsTo
    {
        return $this->belongsTo(Cor::class, 'cor_id', 'id');
    }
}
