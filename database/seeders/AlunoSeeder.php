<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aluno;

class AlunoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         for ($i = 1; $i <= 3000; $i++) {
            Aluno::create([
                'nome' => fake('pt_PT')->name(),
                'email' => fake('pt_PT')->unique()->safeEmail(),
                'telefone' => fake('pt_PT')->phoneNumber(),
                'nif' => fake()->unique()->numerify('#########'), // Gera um NIF de 9 dígitos
                'genero' => rand(0, 1) ? 'Masculino' : 'Femenino',
                'endereco' => fake('pt_PT')->name(),
                'data_nascimento' => fake('pt_PT')->dateTimeBetween('-25 years', '-10 years')->format('Y-m-d'),
            ]);
        }
    }
}
