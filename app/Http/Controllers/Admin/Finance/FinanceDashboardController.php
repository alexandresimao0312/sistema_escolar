<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Http\Controllers\Controller;
use App\Models\Receita;
use App\Models\Despesa;
use App\Models\Caixa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinanceDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mesAtual = Carbon::now()->month;
        $anoAtual = Carbon::now()->year;

   //     $receitasMes = Receita::whereMonth('data', $mesAtual)->whereYear('data', $anoAtual)->sum('valor');
     //   $despesasMes = Despesa::whereMonth('data', $mesAtual)->whereYear('data', $anoAtual)->sum('valor');

        $totalReceitas = Receita::sum('valor');
        $totalDespesas = Despesa::sum('valor');

        $saldoCaixa = $totalReceitas - $totalDespesas;
       // $saldo = Caixa::latest()->first()?->saldo_total ?? 0;

        $graficoMensal = $this->getDadosGraficoAnual();

        return view('financeiro.dashboard', compact('graficoMensal','saldoCaixa'
    ,'totalReceitas', 'totalDespesas'));
    }

     protected function getDadosGraficoAnual()
    {
        $dados = [];
        for ($i = 1; $i <= 12; $i++) {
            $dados['meses'][] = Carbon::create()->month($i)->locale('pt_BR')->translatedFormat('F');
            $dados['receitas'][] = Receita::whereMonth('data', $i)->sum('valor');
            $dados['despesas'][] = Despesa::whereMonth('data', $i)->sum('valor');
        }
        return $dados;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
