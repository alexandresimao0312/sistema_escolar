<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Salario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class SalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
     $query = Salario::with('funcionario');

    if ($request->filled('nome')) {
        $query->whereHas('funcionario', function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->nome . '%');
        });
    }

    if ($request->filled('created_at')) {
        $query->where('created_at', $request->created_at);
    }

    $salarios = $query->orderByDesc('id')->paginate(10);

    return view('escola.admin.admin.salarios.index', [
        'salarios' => $salarios,
        'filtros' => $request->only(['nome', 'created_at']),
    ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $funcionarios = Funcionario::all();
        return view('escola.admin.admin.salarios.create', compact('funcionarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
          $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'salario_base' => 'required|numeric',
            'bonus' => 'nullable|numeric',
            'descontos' => 'nullable|numeric',
            'referente_mes' => 'required|date',
        ]);


        $total = $request->salario_base + $request->bonus - $request->descontos;
        $funcionario_id = "nome";

     $salario =  Salario::create([
            'funcionario_id' => $request->funcionario_id,
            'salario_base' => $request->salario_base,
            'bonus' => $request->bonus,
            'descontos' => $request->descontos,
            'total_recebido' => $total,
            'referente_mes' => $request->referente_mes,
             'cargo' => $request->cargo,
            
        ]);

        event(new \App\Events\SalarioPago($salario));

        return redirect()->route('admin.salarios.index')->with('success', 'Salário registrado com sucesso.');
 

    }

    /**
     * Display the specified resource.
     */
    public function show(Salario $salario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salario $salario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salario $salario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salario $salario)
    {
        //
    }

public function buscarFuncionarios(Request $request)
{
  
    $search = $request->input('q');

    $funcionarios = Funcionario::where('nome', 'like', '%' . $search . '%')->get();

    $results = $funcionarios->map(function ($funcionario) {
        return [
            'id' => $funcionario->id,
            'text' => $funcionario->nome,
            'salario_base' => $funcionario->salario_base,
            'cargo' => $funcionario->cargo,
        ];
    });

    return response()->json(['results' => $results]);
}

    public function gerarRecibo($id)
    {
        $salario = Salario::with('funcionario')->findOrFail($id);

        $pdf = Pdf::loadView('escola.admin.secretaria.exports.salario', compact('salario'));

        return $pdf->download('recibo_salárial_de_' . $salario->funcionario->nome . '.pdf');
    }

    public function verificarRecibo($codigo)
{
    try {
        // Verifica se começa com o prefixo esperado
        if (!Str::startsWith($codigo, 'RECIBO-')) {
            abort(404, 'Código inválido');
        }

        // Extrai a parte criptografada
        $parteCodificada = Str::after($codigo, 'RECIBO-');

        // Decodifica o ID e o mês
        $dados = explode('-', base64_decode($parteCodificada));

        $salarioId = $dados[0] ?? null;

        if (!$salarioId || !is_numeric($salarioId)) {
            abort(404, 'Código de recibo inválido');
        }

        // Busca o salário no banco de dados
        $salario = Salario::with('funcionario')->findOrFail($salarioId);

        return view('salarios.verificar', compact('salario', 'codigo'));

    } catch (\Exception $e) {
        return abort(404, 'Recibo não encontrado ou código inválido.');
    }

}
    public function validarRecibo()
     {
        return view('escola.admin.QR_code.salario');
    }
}
