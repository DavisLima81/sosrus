<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntecedenciaPermuta extends Model
{
    use HasFactory;

    protected $table = 'antecedencia_permutas';

    protected $fillable = [
        'horas_antecedencia',
        'created_at',
        'updated_at',
    ];
}
