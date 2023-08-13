<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar secoes
        DB::table('secoes')->insert([
            ['nome' => 'Comando', 'sigla' => 'CMD',],
            ['nome' => 'Secão Administrativa', 'sigla' => 'SAD',],
            ['nome' => 'Seção Operacional', 'sigla' => 'SOP',],
            ['nome' => 'Seção de Manutenção Aeronáutica', 'sigla' => 'SMA',],
            ['nome' => 'Seção Aeromédica', 'sigla' => 'SAM',],
            ['nome' => 'Assessoria de Segurança Operacional', 'sigla' => 'ASO',],
            ['nome' => 'Assessoria de Projetos e Aquisições', 'sigla' => 'APA',],
            ['nome' => 'Assessoria de Informações e Intelignência', 'sigla' => 'AII',],
            ['nome' => 'Subseção de Serviços Gerais', 'sigla' => 'SSG',],
            ['nome' => 'Subseção de Manutenção e Transportes', 'sigla' => 'SMT',],
        ]);
    }
}
