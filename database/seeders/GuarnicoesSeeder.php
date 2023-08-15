<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuarnicoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar guarnicoes
        DB::table('guarnicoes')->insert([
            ['sigla' => 'SAR', 'nome' => 'Busca e Salvamento (SAR)', 'Descricao' => 'Equipe de serviço de busca e salvamento com helicóptero'],
            ['sigla' => 'AMD', 'nome' => 'Aeromédico', 'Descricao' => 'Equipe de serviço de transporte aeromédico com helicóptero'],
            ['sigla' => 'ATC', 'nome' => 'Auto Tanque de Combustível', 'Descricao' => 'Equipe de serviço de transporte com viatura de combustível para aeronaves'],
            ['sigla' => 'COV', 'nome' => 'Convant', 'Descricao' => 'Equipe de serviço de operações com UAS'],

        ]);
    }
}
