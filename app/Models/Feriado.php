<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feriado extends Model
{
    use HasFactory;

    protected $table = 'feriados';

    protected $fillable = [
        'nome',
        'data',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [
        ])
    {
        parent::__construct($attributes);
    }
}
