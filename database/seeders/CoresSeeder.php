<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar secoes
        DB::table('cores')->insert([
            ['nome' => 'gray-600', 'hexadecimal' => '#4b5563',],
            ['nome' => 'gray-900', 'hexadecimal' => '#111827',],
            ['nome' => 'neutral-600', 'hexadecimal' => '#525252',],
            ['nome' => 'neutral-900', 'hexadecimal' => '#171717',],
            ['nome' => 'red-400', 'hexadecimal' => '#f87171',],
            ['nome' => 'red-700', 'hexadecimal' => '#b91c1c',],
            ['nome' => 'red-950', 'hexadecimal' => '#450a0a',],
            ['nome' => 'orange-400', 'hexadecimal' => '#fb923c',],
            ['nome' => 'orange-600', 'hexadecimal' => '#ea580c',],
            ['nome' => 'orange-900', 'hexadecimal' => '#7c2d12',],
            ['nome' => 'yellow-400', 'hexadecimal' => '#facc15',],
            ['nome' => 'yellow-600', 'hexadecimal' => '#ca8a04',],
            ['nome' => 'yellow-900', 'hexadecimal' => '#713f12',],
            ['nome' => 'green-400', 'hexadecimal' => '#4ade80',],
            ['nome' => 'green-600', 'hexadecimal' => '#16a34a',],
            ['nome' => 'green-900', 'hexadecimal' => '#14532d',],
            ['nome' => 'cyan-400', 'hexadecimal' => '#22d3ee',],
            ['nome' => 'cyan-600', 'hexadecimal' => '#0891b2',],
            ['nome' => 'cyan-900', 'hexadecimal' => '#164e63',],
            ['nome' => 'blue-400', 'hexadecimal' => '#60a5fa',],
            ['nome' => 'blue-600', 'hexadecimal' => '#2563eb',],
            ['nome' => 'blue-900', 'hexadecimal' => '#1e3a8a',],
            ['nome' => 'violet-400', 'hexadecimal' => '#a78bfa',],
            ['nome' => 'violet-600', 'hexadecimal' => '#7c3aed',],
            ['nome' => 'violet-900', 'hexadecimal' => '#4c1d95',],
            ['nome' => 'purple-400', 'hexadecimal' => '#c084fc',],
            ['nome' => 'purple-600', 'hexadecimal' => '#9333ea',],
            ['nome' => 'purple-900', 'hexadecimal' => '#581c87',],
            ['nome' => 'pink-400', 'hexadecimal' => '#f472b6',],
            ['nome' => 'pink-600', 'hexadecimal' => '#db2777',],
            ['nome' => 'pink-900', 'hexadecimal' => '#831843',],

        ]);
    }
}
