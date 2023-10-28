<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubunidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar subunidades
        DB::table('subunidades')->insert([
            ['nome' => 'Grupamento de Operações Aéreas', 'sigla' => 'GOA',],
            ['nome' => '1º Destacamento do Grupamento de Operações Aéreas', 'sigla' => '1/GOA',],
            ['nome' => 'Coordenadoria de Operações com Veículos Aéreos Não Tripulados', 'sigla' => 'COVANT',],
            ['nome' => 'Unidade ou Órgão de fora da estrutura do GOA', 'sigla' => 'ASA',],
        ]);
    }
}
