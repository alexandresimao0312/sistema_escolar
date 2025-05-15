<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AjusteMensalidade;
use App\Models\Curso;
use App\Models\Classe;
use Illuminate\Http\Request;

class AjusteMensalidadeController extends Controller
{
   
    public function index()
    {
        $ajustes = AjusteMensalidade::with(['curso', 'classe'])->paginate(10);
        return view('escola.admin.ajusteMensalidades.index', compact('ajustes'));
    }

    public function create()
    {
        $cursos = Curso::all();
        $classes = Classe::all();
        return view('escola.admin.ajusteMensalidades.create', compact('cursos', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required',
            'classe_id' => 'required',
            'ajuste' => 'required|numeric|min:0',
        ]);

        AjusteMensalidade::create($request->all());

        return redirect()->route('admin.ajustes.index')->with('success', 'Ajuste de mensalidade criado com sucesso!');
    }

    public function edit(AjusteMensalidade $ajuste)
    {
        $cursos = Curso::all();
        $classes = Classe::all();
        return view('escola.admin.ajusteMensalidades.edit', compact('ajuste', 'cursos', 'classes'));
    }

    public function update(Request $request, AjusteMensalidade $ajuste)
    {
        $request->validate([
            'curso_id' => 'required',
            'classe_id' => 'required',
            'ajuste' => 'required|numeric|min:0',
        ]);

        $ajuste->update($request->all());

        return redirect()->route('admin.ajustes.index')->with('success', 'Ajuste de mensalidade atualizado com sucesso!');
    }

    public function destroy(AjusteMensalidade $ajuste)
    {
        $ajuste->delete();

        return redirect()->route('admin.ajustes.index')->with('success', 'Ajuste de mensalidade excluído com sucesso!');
    }
    
        public function classesPorCurso($curso_id)
    {
        $classes = Classe::where('curso_id', $curso_id)->get();
        return response()->json($classes);
    }

}
