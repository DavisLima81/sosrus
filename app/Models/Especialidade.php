<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidade extends Model
{
    use HasFactory;

    protected $table = 'especialidades';

    protected $fillable = [
        'quadro_id',
        'nome',
        'sigla',
        'codigo',
        'created_at',
        'updated_at',
    ];

    public function efetivos(): HasMany
    {
        return $this->hasMany(Efetivo::class);
    }

    public function quadro(): HasMany
    {
        return $this->hasMany(Efetivo::class);
    }
}
