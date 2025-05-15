<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Mensalidade;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
   
    public function index()
    {
        return view('home');
    }
    public function dashb()
{
    $total_pagamentos = Pagamento::sum('valor_pago');
    $mensalidades_pagas = Pagamento::where('id')->count();
    $mensalidades_pendentes = Mensalidade::where('estado', 'pendente')->count();

    return view('escola.admin.secretaria.dashboard', compact('total_pagamentos', 'mensalidades_pagas', 'mensalidades_pendentes'));
}


public function dashboard()
{
    $alunosPorNivel = DB::table('matriculas')
    ->join('cursos', 'matriculas.curso_id', '=', 'cursos.id')
    ->select('cursos.tipo as nivel', DB::raw('count(*) as total'))
    ->groupBy('cursos.tipo')
    ->get();

$labels = $alunosPorNivel->pluck('nivel');
$valores = $alunosPorNivel->pluck('total');

    return view('escola.admin.secretaria.dashboard', compact('labels', 'valores'));
}


}
