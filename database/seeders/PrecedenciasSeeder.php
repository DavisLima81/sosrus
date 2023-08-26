<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrecedenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar precedencias
        DB::table('precedencias')->insert([
            ['nome' => 'Soldado', 'sigla' => 'SD'],
            ['nome' => 'Cabo', 'sigla' => 'CB'],
            ['nome' => '3º Sargento', 'sigla' => '3 SGT'],
            ['nome' => '2º Sargento', 'sigla' => '2 SGT'],
            ['nome' => '1º Sargento', 'sigla' => '1 SGT'],
            ['nome' => 'Subtenente', 'sigla' => 'SUBTEN'],
            ['nome' => 'Cadete', 'sigla' => 'CAD'],
            ['nome' => 'Aspirante', 'sigla' => 'ASP'],
            ['nome' => '2º Tenente', 'sigla' => '2 TEN'],
            ['nome' => '1º Tenente', 'sigla' => '1 TEN'],
            ['nome' => 'Capitão', 'sigla' => 'CAP'],
            ['nome' => 'Major', 'sigla' => 'MAJ'],
            ['nome' => 'Tenente Coronel', 'sigla' => 'TCEL'],
            ['nome' => 'Coronel', 'sigla' => 'CEL'],

        ]);

    }
}
