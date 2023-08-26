<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuadrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar quadros
        DB::table('quadros')->insert([
            ['nome' => 'Quadro BM Profissional', 'sigla' => 'QBMP'],
            ['nome' => 'Quadro de Oficiais Combatentes', 'sigla' => 'QOC'],
            ['nome' => 'Quadro de Oficiais de Saúde', 'sigla' => 'QOS'],
            ['nome' => 'Quadro de Oficiais Administrativos', 'sigla' => 'QOA'],
            ['nome' => 'Quadro de Oficiais Capelães', 'sigla' => 'QOCap'],
            ['nome' => 'Quadro de Oficiais Temporários Voluntários', 'sigla' => 'QOTV'],
            ['nome' => 'Serviço Militar Temporário Voluntário', 'sigla' => 'SMTV'],

        ]);
    }
}
