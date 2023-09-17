<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AntecedenciaPermutasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar secoes
        DB::table('antecedencia_permutas')->insert([
            ['horas_antecedencia' => 24],
        ]);
    }
}
