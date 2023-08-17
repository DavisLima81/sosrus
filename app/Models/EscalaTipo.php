<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalaTipo extends Model
{
    use HasFactory;

    protected $table = 'escala_tipos';

    protected $fillable = [
        'nome',
        'descricao',
        'created_at',
        'updated_at',
    ];

    public function escalas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Escala::class, 'escala_tipo_id');
    }
}
