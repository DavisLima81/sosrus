<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
