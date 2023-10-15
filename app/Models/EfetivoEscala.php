<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EfetivoEscala extends Model
{
    use HasFactory;

    protected $table = 'efetivos_escalas';

    protected $fillable = [
        'efetivo_id',
        'escala_id',
        'created_at',
        'updated_at',
    ];
}
