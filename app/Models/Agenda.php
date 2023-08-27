<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $resumo
 * @property string $descricao
 * @property string $localizacao
 * @property int $cor_id
 * @property string $time_zone
*/
class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';

    protected $fillable = [
        'resumo',
        'descricao',
        'localizacao',
        'cor_id'
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class, 'agenda_id', 'id');
    }

    public function cor() : BelongsTo
    {
        return $this->belongsTo(Cor::class, 'cor_id', 'id');
    }

    public function timeZone() : string
    {
        $time_zone = date_default_timezone_get();
        $this->time_zone = $time_zone;
        return $this->time_zone;
    }
}
