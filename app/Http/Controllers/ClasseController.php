<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Curso;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $classes = Classe::with('curso')->latest()->paginate(6);
        return view('escola.admin.admin.classes.index', compact('classes'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cursos = Curso::all();
        return view('escola.admin.admin.classes.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Classe::create($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe criada com sucesso!');
    }

    public function edit(Classe $class)
    {
        $cursos = Curso::all();
        return view('escola.admin.admin.classes.edit', [
            'classe' => $class,
            'cursos' => $cursos
        ]);
    }

    public function update(Request $request, Classe $class)
    {
        $request->validate([
            'nome' => 'required|string',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $class->update($request->all());

        return redirect()->route('admin.classes.index')->with('success', 'Classe atualizada com sucesso!');
    }

    public function destroy(Classe $class)
    {
        $class->delete();
        //
    }
    public function porCurso($curso_id)
    {
        $classes = Classe::where('curso_id', $curso_id)->get();
        return response()->json($classes);
    }
    public function list()
    {
        $classes = Classe::with('curso')->latest()->paginate(6);
        return view('escola.admin.secretaria.classes.index', compact('classes'));
    }

}
