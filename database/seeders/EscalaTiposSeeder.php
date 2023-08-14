<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EscalaTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar escala_tipos
        DB::table('escala_tipos')->insert([
            ['nome' => 'Expediente', 'Descricao' => 'Trabalho regular em expdiente administrativo em OBM ou local administrado por OBM'],
            ['nome' => 'Serviço', 'descricao' => 'Trabalho de pronto emprego ou plantão em OBM ou local administrado por OBM'],
            ['nome' => 'Sobreaviso', 'descricao' => 'Disponibilidade para acionamento para serviço, sem permanecer em OBM ou local administrado por OBM'],
            ['nome' => 'Permanência', 'descricao' => 'Disponibilidade para acionamento para trabalho administrativo, permanecendo em OBM ou local administrado por OBM'],
        ]);
    }
}
