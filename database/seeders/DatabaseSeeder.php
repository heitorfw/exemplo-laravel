<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Defina o número de registros que você deseja inserir
        $quantidade = 10;

        for ($i = 0; $i < $quantidade; $i++) {
            // Escolha aleatoriamente entre 'CPF' e 'CNPJ'
            $tipoDocumento = (rand(0, 1) === 0) ? 'CPF' : 'CNPJ';

            DB::table('users')->insert([
                'name' => 'Test User ' . Str::random(5), // Nome único para cada usuário
                'email' => 'test' . Str::random(5) . '@example.com', // Email único
                'email_verified_at' => Carbon::now(), // Data e hora atuais
                'password' => bcrypt('password'), // Senha criptografada
                'remember_token' => Str::random(10), // Token aleatório
                'created_at' => Carbon::now(), // Data e hora atuais
                'updated_at' => Carbon::now(), // Data e hora atuais
            ]);
        }
    }
}
