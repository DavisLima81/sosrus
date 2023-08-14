<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
