<?php

namespace App\Http\Controllers;

use App\Http\Requests\MensalidadeRequest;
use App\Models\Mensalidade;
use App\Models\Matricula;
use App\Models\Aluno;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotificacaoMensalidade;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\LogAtividade;


class MensalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $mensalidades = Mensalidade::with('matricula.aluno')->latest()->paginate(5);
        return view('escola.admin.secretaria.mensalidades.mensalidade', compact('mensalidades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $matriculas = Matricula::with('aluno')->get();
        return view('escola.admin.secretaria.mensalidades.mensalidadeCriar', compact('matriculas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MensalidadeRequest $request)
    {
        //
       $mensalidade = Mensalidade::create([
            'matricula_id' => $request->matricula_id,
            'mes' => $request->mes,
            'ano' => $request->ano,
            'valor' => $request->valor,
            'estado' => 'pendente',
            'data_vencimento' => $request->data_vencimento,
        ]);
            // Após criar mensalidade, por exemplo:
            LogAtividade::create([
                'secretaria_id' => auth('secretaria')->id(),
                'acao' => 'Criou uma nova Mensalidade',
                'entidade_afetada' => 'mensalidade',
                'id_entidade' => $mensalidade->id,
                'detalhes' => 'Mensalidade Criada no Mes: ' . $mensalidade->mes,
            ]);
        
        return redirect()->route('secretaria.mensalidades.create')->with('success', 'Mensalidade criada com sucesso.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mensalidade $mensalidade)
    {
        //
        return view('escola.admin.mensalidades.mensalidadeInf', compact('mensalidade'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mensalidade $mensalidade)
    {
        $matriculas = Matricula::with('aluno')->get();
        return view('escola.admin.financeiro.mensalidades.edit', compact('mensalidade', 'matriculas'));
    }

    public function update(MensalidadeRequest $request, Mensalidade $mensalidade)
    {

        $mensalidade->update($request->only([
            'matricula_id', 'mes', 'ano', 'valor', 'data_vencimento'
        ]));

           // Após criar mensalidade, por exemplo:
           LogAtividade::create([
            'secretaria_id' => auth('secretaria')->id(),
            'acao' => 'Atualizou uma Mensalidade',
            'entidade_afetada' => 'mensalidade',
            'id_entidade' => $mensalidade->id,
            'detalhes' => 'Mensalidade Atualizada No Mes: ' . $mensalidade->mes,
        ]);

        return redirect()->route('secretaria.mensalidades.edit')->with('success', 'Mensalidade atualizada com sucesso.');
    }

    public function destroy(Mensalidade $mensalidade)
    {
        $mensalidade->delete();
        return redirect()->route('secretaria.mensalidades.index')->with('success', 'Mensalidade excluída com sucesso.');
    }

    // 🔁 Função para marcar como paga
    public function pagar($id)
    {
        $mensalidade = Mensalidade::findOrFail($id);
        $mensalidade->update([
            'estado' => 'pago',
            'data_pagamento' => now(),
        ]);
          // Após criar mensalidade, por exemplo:
          LogAtividade::create([
            'secretaria_id' => auth('secretaria')->id(),
            'acao' => 'Apagada uma Mensalidade',
            'entidade_afetada' => 'mensalidade',
            'id_entidade' => $mensalidade->id,
            'detalhes' => 'Mensalidade Apagada No Mes: ' . $mensalidade->mes,
        ]);

        return redirect()->route('secretaria.mensalidades.index')->with('success', 'Mensalidade marcada como paga.');
    }

    public function gerarComprovativo($id)
{
    $mensalidade = Mensalidade::with('matricula.aluno')->findOrFail($id);

    $pdf = Pdf::loadView('escola.admin.secretaria.mensalidades.comprovativo', compact('mensalidade'));

    return $pdf->download("comprovativo-{$mensalidade->id}.pdf");
}
public function search(Request $request)
{
    $request->validate([
        'keyword' => 'required',
        'tipoDeBusca' => 'required',
    ]);
    
    $keyword = $request->input('keyword');
    $tipoDeBusca = $request->input('tipoDeBusca');

    $mensalidade = Aluno::where("{$tipoDeBusca}", 'LIKE', "%{$keyword}%")->paginate(4);
    dd($mensalidade);
    
    return view('escola.admin.secretaria.alunos.alunoPesquisa', compact('aluno', 'keyword','tipoDeBusca'));
}

public function buscarDividas($alunoId)
{
    try {
        // Verifica se existe uma matrícula associada ao aluno
        $matricula = \App\Models\Matricula::where('aluno_id', $alunoId)->first();

        if (!$matricula) {
            return response()->json(['error' => 'Matrícula não encontrada.'], 404);
        }


        $mensalidades = Mensalidade::with(['matricula.curso']) // traz o curso
        ->where('matricula_id', $matricula->id)
        ->where('estado', 'pendente')
        ->get();
       
       
        return response()->json($mensalidades);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao buscar mensalidades.'], 500);
    }
}
public function buscar(Request $request)
{
    $termo = $request->get('q', '');

    $matriculas = \App\Models\Matricula::whereHas('aluno', function ($query) use ($termo) {
            $query->where('nome', 'like', '%' . $termo . '%');
        })
        ->with('aluno:id,nome')
        ->select('id', 'aluno_id')
        ->limit(20)
        ->get();

    $resultados = $matriculas->map(function ($matricula) {
        return [
            'id' => $matricula->id,
            'text' => $matricula->aluno->nome . ' (Matrícula ID: ' . $matricula->id . ')'
        ];
    });

    return response()->json(['results' => $resultados]);
}
public function exportarPDF()
{
    $mensalidades = Mensalidade::with('matricula.aluno', 'matricula.curso')
        ->orderByDesc('created_at')
        ->get();

    $pdf = Pdf::loadView('escola.admin.secretaria.exports.mensalidades_pdf', compact('mensalidades'));
    return $pdf->download('mensalidades.pdf');
}


}