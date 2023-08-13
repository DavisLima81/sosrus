<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Secao extends Model
{
    use HasFactory;

    protected $table = 'secoes';

    protected $fillable = [
        'nome',
        'sigla',
        'created_at',
        'updated_at',
    ];

    public function efetivos(): HasMany
    {
        return $this->hasMany(Efetivo::class);
    }
}
