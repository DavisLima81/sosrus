<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //chama as seeders
        $this->call([
            UsersSeeder::class,
            PrecedenciasSeeder::class,
            QuadrosSeeder::class,
            EspecialidadesSeeder::class,
            SubunidadesSeeder::class,
            SecoesSeeder::class,
            FuncoesSeeder::class,
            StatusSeeder::class,
            EfetivosSeeder::class,
            EscalaTiposSeeder::class,
            RegimesSeeder::class,
            GuarnicoesSeeder::class,
            DoAnoMesesSeeder::class,
            EscalasSeeder::class,
            CoresSeeder::class,
            AntecedenciaPermutasSeeder::class,
        ]);
    }
}
