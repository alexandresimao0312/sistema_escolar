<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Classe;
use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Support\Carbon;
class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $alunos = Aluno::all();

        foreach ($alunos as $aluno) {
            // Sorteia um curso aleatório
            $curso = Curso::inRandomOrder()->first();

            if (!$curso) continue;

            // Seleciona uma classe relacionada ao curso
            $classe = Classe::where('curso_id', $curso->id)->inRandomOrder()->first();

            // Seleciona uma turma relacionada ao curso
            $turma = Turma::where('curso_id', $curso->id)->inRandomOrder()->first();

            if (!$classe || !$turma) continue;

            Matricula::create([
                'aluno_id'       => $aluno->id,
                'curso_id'       => $curso->id,
                'classe_id'      => $classe->id,
                'turma_id'       => $turma->id,
                'turno'          => collect(['Manhã', 'Tarde', 'Noite'])->random(),
                'data_matricula' => Carbon::now()->subDays(rand(0, 60)),
            ]);
        }

    }

    }
