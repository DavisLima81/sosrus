<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermutaPrazo extends Model
{
    use HasFactory;

    protected $fillable = [
        'horas_antecedencia',
        'created_at',
        'updated_at',
    ];

    protected $table = 'permuta_prazos';

    protected function handleRecordCreation(array $data): PermutaPrazo
    {
        $list[] = null;
        $prazos = PermutaPrazo::all();
        foreach ($prazos as $prazo) {
            $list[] = $prazo->id;
        }
        if (count($list) > 1) {
            PermutaPrazo::destroy($list);
        }

        return static::getModel()::create($data);
    }
}
