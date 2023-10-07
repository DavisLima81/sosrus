<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermutaPrazosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar precedencias
        DB::table('permuta_prazos')->insert([
            ['horas_antecedencia' => 24],
        ]);

    }
}
