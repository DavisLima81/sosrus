<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar status
        DB::table('status')->insert([
            ['nome' => 'Disponível', 'sigla' => 'DISP'],
            ['nome' => 'Férias', 'sigla' => 'FERI'],
            ['nome' => 'Licença Médica', 'sigla' => 'LMED'],
            ['nome' => 'Licença Maternidade ou Paternidade', 'sigla' => 'LMPA'],
            ['nome' => 'Luto', 'sigla' => 'LUTO'],
            ['nome' => 'Liceça Especial', 'sigla' => 'LESP'],
            ['nome' => 'Licença para Tratar de Interesse Particular', 'sigla' => 'LTIP'],
            ['nome' => 'A Disposição de Curso', 'sigla' => 'CRSO'],
        ]);
    }
}
