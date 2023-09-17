<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar escalas
        DB::table('escalas')->insert([
            [
                'escala_tipo_id' => 1, //expediente
                'guarnicao_id' => 5, //SAD
                'nome' => 'Of expediente',
                'descricao' => 'Oficial responsável pelo expediente',
                'inicio' => '8',
                'duracao' => 8,
                'regime_id' => 2, //expediente integral
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => null,
            ],
        ]);
    }
}
