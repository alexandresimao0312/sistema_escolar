<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cursos = Curso::all();
        return view('escola.admin.secretaria.curso.curso', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('escola.admin.secretaria.curso.cursoCriar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:primário,secundário,médio',
            'valor_mensalidade' => 'required|numeric',
        ]);

        Curso::create($request->all());

        return redirect()->route('admin.cursos.index')->with('success', 'Curso criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
        return view('escola.admin.secretaria.curso.cursoInf', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        //
        return view('escola.admin.secretaria.curso.cursoEdit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        //
        
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:primário,secundário,médio',
            'valor_mensalidade' => 'required|numeric',
        ]);

        $curso->update($request->all());

        return redirect()->route('admin.cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        //
        $curso->delete();
        return redirect()->route('admin.cursos.index')->with('success', 'Curso deletado com sucesso!');
    }
    public function list()
    {
        $cursos = Curso::all();
        return view('escola.admin.secretaria.curso.index', compact('cursos'));
    }

    public function toggleStatus($id)
{
    $curso = Curso::findOrFail($id);
    $curso->ativo = !$curso->ativo;
    $curso->save();

    return redirect()->route('admin.cursos.index')->with('success', 'Estado do curso atualizado.');
}

  
}

