<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //criar usuário
        DB::table('users')->insert([
            ['name' => 'davis', 'email' => 'davislima81@yahoo.com.br', 'password' => bcrypt('bravofox71')],
            ['name' => 'fulano', 'email' => 'fulano@test.com', 'password' => bcrypt('senha')],
            ['name' => 'ciclano', 'email' => 'ciclano@test.com', 'password' => bcrypt('senha')],
            ['name' => 'joao', 'email' => 'joao@test.com', 'password' => bcrypt('senha')],
            ['name' => 'pedro', 'email' => 'pedro@test.com', 'password' => bcrypt('senha')],
            ['name' => 'jose', 'email' => 'jose@test.com', 'password' => bcrypt('senha')],
            ['name' => 'maria', 'email' => 'maria@test.com', 'password' => bcrypt('senha')],
            ['name' => 'joaquina', 'email' => 'joaquina@test.com', 'password' => bcrypt('senha')],
        ]);
    }
}
