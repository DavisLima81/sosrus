<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subunidade extends Model
{
    use HasFactory;

    protected $table = 'subunidades';

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
