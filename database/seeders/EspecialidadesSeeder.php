<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar especialidades
        DB::table('especialidades')->insert([
            //praças
            ['nome' => 'Combatente', 'sigla' => '00', 'codigo' => ''],
            ['nome' => 'Busca e Salvamento', 'sigla' => '01', 'codigo' => ''],
            ['nome' => 'Motorista', 'sigla' => '02', 'codigo' => ''],
            ['nome' => 'Manutenção', 'sigla' => '03', 'codigo' => ''],
            ['nome' => 'Músico', 'sigla' => '04', 'codigo' => ''],
            ['nome' => 'Comunicações', 'sigla' => '05', 'codigo' => ''],
            ['nome' => 'Auxiliar de Saúde', 'sigla' => '06', 'codigo' => ''],
            ['nome' => 'Corneteiro', 'sigla' => '07', 'codigo' => ''],
            ['nome' => 'Operador de embarcações', 'sigla' => '08', 'codigo' => ''],
            ['nome' => 'Operador de hidrantes', 'sigla' => '09', 'codigo' => ''],
            ['nome' => 'Guarda Vidas', 'sigla' => '10', 'codigo' => ''],
            //oficiais
            ['nome' => 'Combatente', 'sigla' => 'COM', 'codigo' => ''],
            ['nome' => 'Médico', 'sigla' => 'MED', 'codigo' => ''],
            ['nome' => 'Psicólogo', 'sigla' => 'PSI', 'codigo' => ''],
            ['nome' => 'Nutrólogo', 'sigla' => 'NUT', 'codigo' => ''],
            ['nome' => 'Assistente Social', 'sigla' => 'ASS', 'codigo' => ''],
            ['nome' => 'Enfermeiro', 'sigla' => 'ENF', 'codigo' => ''],



        ]);
    }
}
