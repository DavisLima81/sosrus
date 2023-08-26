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
            ['quadro_id' => 1, 'nome' => 'Combatente', 'sigla' => '00', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Busca e Salvamento', 'sigla' => '01', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Motorista', 'sigla' => '02', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Manutenção', 'sigla' => '03', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Músico', 'sigla' => '04', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Comunicações', 'sigla' => '05', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Auxiliar de Saúde', 'sigla' => '06', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Corneteiro', 'sigla' => '07', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Operador de embarcações', 'sigla' => '08', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Operador de hidrantes', 'sigla' => '09', 'codigo' => ''],
            ['quadro_id' => 1, 'nome' => 'Guarda Vidas', 'sigla' => '10', 'codigo' => ''],
            ['quadro_id' => 7, 'nome' => 'Combatente', 'sigla' => 'COM', 'codigo' => ''],
            //oficiais
            ['quadro_id' => 2, 'nome' => 'Combatente', 'sigla' => 'COM', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Médico', 'sigla' => 'MED', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Psicólogo', 'sigla' => 'PSI', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Nutrólogo', 'sigla' => 'NUT', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Assistente Social', 'sigla' => 'ASS', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Enfermeiro', 'sigla' => 'ENF', 'codigo' => ''],
            ['quadro_id' => 3, 'nome' => 'Fonoaudiólogo', 'sigla' => 'FON', 'codigo' => ''],
            ['quadro_id' => 4, 'nome' => 'Administrativo', 'sigla' => 'ADM', 'codigo' => ''],
            ['quadro_id' => 5, 'nome' => 'Evangélico', 'sigla' => 'EVA', 'codigo' => ''],
            ['quadro_id' => 5, 'nome' => 'Católico', 'sigla' => 'CAT', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Médico', 'sigla' => 'MED', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Psicólogo', 'sigla' => 'PSI', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Nutrólogo', 'sigla' => 'NUT', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Assistente Social', 'sigla' => 'ASS', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Enfermeiro', 'sigla' => 'ENF', 'codigo' => ''],
            ['quadro_id' => 6, 'nome' => 'Fonoaudiólogo', 'sigla' => 'FON', 'codigo' => ''],
        ]);
    }
}
