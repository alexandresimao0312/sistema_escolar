<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Aluno;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DocumentoRequest;
use App\Models\User;


class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        $documentos = Documento::with(['aluno', 'funcionario', 'emissor'])->latest()->paginate(6);
        return view('escola.admin.secretaria.documentos.documento', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $alunos = Aluno::all();
        $funcionarios = Funcionario::all();
        return view('documentos.create', compact('alunos', 'funcionarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentoRequest $request)
    {
        //
        $path = $request->file('arquivo')->store('documentos');

        Documento::create([
            'titulo' => $request->titulo,
            'tipo' => $request->tipo,
            'aluno_id' => $request->aluno_id,
            'funcionario_id' => $request->funcionario_id,
            'arquivo' => $path,
        //  'emitido_por' => auth()->id(),
            'data_emissao' => now(),
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->session()->flash()->with('success', 'Documento cadastrado com sucesso!');
        //  return redirect()->route('documentos.index')->with('success', 'Documento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        //
    }
}
