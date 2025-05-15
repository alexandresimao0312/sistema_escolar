<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secretaria;
use Illuminate\Support\Facades\Hash;

class SecretariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Secretaria::create([
            'nome' => 'Secretária Padrão',
            'email' => 'secretaria@escola.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
