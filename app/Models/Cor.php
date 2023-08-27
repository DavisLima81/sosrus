<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *@property string $nome
 *@property string $hexadecimal
 */
class Cor extends Model
{
    use HasFactory;

    protected $table = 'cores';

    protected $fillable = [
        'nome',
        'hexadecimal',
        'created_at',
        'updated_at',
    ];

    public function agendas() : HasMany
    {
        return $this->hasMany(Agenda::class, 'cor_id', 'id');
    }

    public function eventos() : HasMany
    {
        return $this->hasMany(Evento::class, 'cor_id', 'id');
    }
}
