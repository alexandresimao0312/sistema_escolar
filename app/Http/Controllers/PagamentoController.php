<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagamentoRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Mensalidade;
use Illuminate\Support\Facades\Storage;
use App\Models\Aluno;
use Illuminate\Container\Attributes\DB as AttributesDB;
use Illuminate\Support\Facades\DB;
use App\Models\LogAtividade;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function inde()
    {
        $pagamentos = Pagamento::with('mensalidade.matricula.aluno', 'mensalidade.matricula.curso')
            ->latest()
            ->paginate(5);

        return view('escola.admin.secretaria.pagamento.pagamento', compact('pagamentos'));

    }

       public function index(Request $request)
    {
        $query = Pagamento::with('mensalidade.matricula.aluno', 'mensalidade.matricula.curso');

    
        if ($request->filled('aluno_id')) {
            $query->where('aluno_id', $request->aluno_id);
        }
        if ($request->filled('forma_pagamento')) {
            $query->where('forma_pagamento', $request->forma_pagamento);
        }

        if ($request->filled('data_pagamento')) {
            $query->where('data_pagamento', $request->data_pagamento);
        }
          if ($request->filled('mensalidade')) {
            $query->whereHas('mensalidade_id', function ($q) use ($request) {
                $q->where('id', $request->mensalidade_id);
            });
        }


        $pagamentos = $query->paginate(8);

        $mensalidades  = Mensalidade::all();
        $alunos = Aluno::all();
      

        return view('escola.admin.secretaria.pagamento.pagamento', compact('mensalidades', 'alunos','pagamentos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
   // Mensalidades pendentes
   $mensalidades = Mensalidade::with('matricula.aluno')
   ->where('estado', 'pendente')
   ->get();

   

return view('escola.admin.secretaria.pagamento.pagamentoCriar', compact('mensalidades'));
}

    /**
     * Store a newly created resource in storage.
     */
  public function store(PagamentoRequest $request)      
    {

        if (!$request->has('mensalidade_id') || !is_array($request->mensalidade_id)) {
            return back()->withErrors(['mensalidade_ids' => 'Selecione pelo menos uma mensalidade.']);
        }  
        
    
        DB::beginTransaction();      
    
        try {
            foreach ($request->mensalidade_id as $mensalidade_id) {
                // Atualiza o estado da mensalidade
                $mensalidade = Mensalidade::findOrFail($mensalidade_id);
                $mensalidade->update([
                    'estado' => 'pago',
                    'data_pagamento' => now(),
                ]);
    
                // Registra o pagamento
           $pagamento = Pagamento::create([
                    'aluno_id' => $request->aluno_id,
                    'mensalidade_id' => $mensalidade_id,
                    'valor_pago' => $mensalidade->valor, // ou use o valor total dividido
                    'forma_pagamento' => $request->forma_pagamento,
                    'data_pagamento' => $request->data_pagamento,
                ]);
            }
            
    
            DB::commit();
    
            return redirect()->route('secretaria.pagamentos.index')->with('success', 'Pagamento registrado com sucesso.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['Erro ao registrar pagamento: ' . $e->getMessage()]);
        }
         // Após criar pagamento, por exemplo:
        LogAtividade::create([
        'secretaria_id' => auth('secretaria')->id(),
        'acao' => 'Criou um novo pagamento',
        'entidade_afetada' => 'pagamento',
        'id_entidade' => $pagamento->id,
        'detalhes' => 'Pagamento Realizado, Mensalidade: ' . $pagamento->mensalidade_id,
    ]);
        return redirect()->route('secretaria.pagamentos.create')->with('success', 'Pagamento registado com sucesso! Comprovativo gerado.');

        // Gerar PDF do comprovativo
        /**
     * Show the form for creating a new resource.
     
        *  $pdf = Pdf::loadView('escola.admin.secretaria.pagamento.comprovativo', [
          *    'pagamento' => $pagamento,
           *   'mensalidade' => $mensalidade,
          *    'aluno' => $mensalidade->matricula->aluno,
        *  ]);
     * return $pdf->download('comprovativo_pagamento.pdf');
    */
    
       
    }

    public function show($id)
    {
        $pagamento = Pagamento::with('mensalidade.matricula.aluno')->findOrFail($id);
        return view('escola.admin.secretaria.pagamento.pagamentoInf', compact('pagamento'));
    }

    public function edit(Pagamento $pagamento)
    {
        $mensalidades = Mensalidade::with('pagamentos', 'matricula.aluno')->get();
        return view('escola.admin.secretaria.pagamento.pagamentoEdit', compact('pagamento', 'mensalidades'));
    }

    public function update(Request $request, Pagamento $pagamento)
    {
        $request->validate([
            'mensalidade_id' => 'required|exists:mensalidades,id',
            'data_pagamento' => 'required|date',
            'valor_pago' => 'required|numeric|min:0',
            'forma_pagamento' => 'required|string',
            'referencia' => 'nullable|string',
        ]);

        $pagamento->update($request->all());

        // Atualiza o estado da mensalidade
        $mensalidade = $pagamento->mensalidade;
        $totalPago = $mensalidade->pagamentos->sum('valor_pago');

        if ($totalPago >= $mensalidade->valor) {
            $mensalidade->estado = 'pago';
            $mensalidade->data_pagamento = $request->data_pagamento;
        } else {
            $mensalidade->estado = 'pendente';
            $mensalidade->data_pagamento = null;
        }
        
            // Após criar pagamento, por exemplo:
            LogAtividade::create([
                'secretaria_id' => auth('secretaria')->id(),
                'acao' => 'Atualizou pagamento',
                'entidade_afetada' => 'pagamento',
                'id_entidade' => $pagamento->id,
                'detalhes' => 'Pagamento Atualizado, Mensalidade: ' . $pagamento->mensalidade_id,
            ]);

        $mensalidade->save();

        

        return redirect()->route('secretaria.pagamentos.index')->with('success', 'Pagamento atualizado!');
    }

    public function destroy(Pagamento $pagamento)
    {
        $mensalidade = $pagamento->mensalidade;
        $pagamento->delete();

        $totalPago = $mensalidade->pagamentos->sum('valor_pago');

        if ($totalPago < $mensalidade->valor) {
            $mensalidade->estado = 'pendente';
            $mensalidade->data_pagamento = null;
            $mensalidade->save();
        }
            // Após criar pagamento, por exemplo:
            LogAtividade::create([
                'secretaria_id' => auth('secretaria')->id(),
                'acao' => 'Apagou um pagamento',
                'entidade_afetada' => 'pagamento',
                'id_entidade' => $pagamento->id,
                'detalhes' => 'Pagamento Apagado, Mensalidade: ' . $pagamento->mensalidade_id,
            ]);

        return redirect()->route('secretaria.pagamentos.index')->with('success', 'Pagamento removido!');
    }
    public function comprovativo($id)
{
    $pagamento = Pagamento::with('mensalidade.matricula.aluno')->findOrFail($id);
    $mensalidade = $pagamento->mensalidade;
    $aluno = $mensalidade->matricula->aluno;
    $pdf = Pdf::loadView('escola.admin.secretaria.pagamento.comprovativo', compact('pagamento', 'mensalidade', 'aluno'));
    return $pdf->download("comprovativo_pagamento_{$aluno->nome}.pdf");
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

public function exportarPDF()
{
    $pagamentos = Pagamento::with('mensalidade.matricula.aluno', 'mensalidade.matricula.curso')
    ->orderByDesc('created_at')
    ->get();

    $pdf = Pdf::loadView('escola.admin.secretaria.exports.pagamentos_pdf', compact('pagamentos'));
    return $pdf->download('pagamentos.pdf');
}


}
