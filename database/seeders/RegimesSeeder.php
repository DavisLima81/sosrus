<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar regimes
        DB::table('regimes')->insert([
            ['sigla' => '24H', 'nome' => '24h / 7d',
                'Descricao' => 'Regime ininterrupto. Ou seja, de 24 horas por dia nos 7 dias da semana.', 'carga' => 24],
            ['sigla' => 'EXP', 'nome' => 'Expediente',
                'Descricao' => 'Regime regular de expediente. Ou seja, dias úteis das 8h às 18h ou equivalente.',
                'carga' => 8],
            ['sigla' => 'MXP', 'nome' => 'Meio expediente',
                'Descricao' => 'Regime reduzido de expediente. Ou seja, dia(s) útil(eis) das 8h às 12h ou equivalente.',
                'carga' => 4],
            ['sigla' => 'PER', 'nome' => 'Permanência',
                'Descricao' => 'Regime de pós expediente. Sáb, dom e feriados e/ou após o expediente regular',
                'carga' => 14],
            ['sigla' => 'REP', 'nome' => 'Representação',
                'Descricao' => 'Missões específicas de representação fora da OBM',
                'carga' => 4],

        ]);
    }
}
