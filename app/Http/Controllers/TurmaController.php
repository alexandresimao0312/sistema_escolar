<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Classe;
use App\Models\Curso;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turmas = Turma::with('classe')->latest()->paginate(10);
        return view('escola.admin.admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        $classes = Classe::with('curso')->get();
        $cursos = Curso::with('turmas')->get();
        return view('escola.admin.admin.turmas.create', compact('classes','cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'classe_id' => 'required|exists:classes,id',
            'ano_letivo' => 'required',
        ]);

        

        Turma::create($request->all());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma criada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        $classes = Classe::with('curso')->get();
        $cursos = Curso::with('turmas')->get();
        return view('escola.admin.admin.turmas.edit', compact('turma', 'classes', 'cursos'));
    }

    public function update(Request $request, Turma $turma)
    {
        $request->validate([
            'nome' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
            'classe_id' => 'required|exists:classes,id',
            'ano_letivo' => 'required',
        ]);

        $turma->update($request->all());

        return redirect()->route('admin.turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();

        return redirect()->route('admin.turmas.index')->with('success', 'Turma removida com sucesso!');
    }
    public function porCursoEClasse($curso_id, $classe_id)
    {
        return response()->json(
            Turma::where('curso_id', $curso_id)
                  ->where('classe_id', $classe_id)
                  ->get()
        );
    }

    public function list()
    {
        $turmas = Turma::with('classe')->latest()->paginate(6);
        return view('escola.admin.secretaria.turmas.index', compact('turmas'));
    }
}
