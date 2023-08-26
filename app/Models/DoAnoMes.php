<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DoAnoMes extends Model
{
    use HasFactory;

    protected $table = 'do_ano_meses';

    protected $fillable = [
        'nome',
        'created_at',
        'updated_at',
    ];

    public function meses() : HasMany
    {
        return $this->hasMany(Mes::class);
    }
}
