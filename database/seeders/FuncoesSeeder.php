<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuncoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar funções
        DB::table('funcoes')->insert([
            ['nome' => 'Comandante', 'sigla' => 'CMD',],
            ['nome' => 'Subcomandante', 'sigla' => 'SMD',],
            ['nome' => 'Chefe', 'sigla' => 'CHF',],
            ['nome' => 'Subchefe', 'sigla' => 'SCF',],
            ['nome' => 'Adjunto', 'sigla' => 'ADJ',],
            ['nome' => 'Colaborador', 'sigla' => 'COL',],
            ['nome' => 'Auxiliar', 'sigla' => 'AUX',],
            ['nome' => 'Escalante', 'sigla' => 'ESC',],
        ]);
    }
}
