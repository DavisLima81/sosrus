<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoAnoMesesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //criar escala_tipos
        DB::table('do_ano_meses')->insert([
            ['nome' => 'Janeiro'],
            ['nome' => 'Fevereiro'],
            ['nome' => 'Março'],
            ['nome' => 'Abril'],
            ['nome' => 'Maio'],
            ['nome' => 'Junho'],
            ['nome' => 'Julho'],
            ['nome' => 'Agosto'],
            ['nome' => 'Setembro'],
            ['nome' => 'Outubro'],
            ['nome' => 'Novembro'],
            ['nome' => 'Dezembro'],
        ]);

    }
}
