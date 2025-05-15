<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Models\Pagamento;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAlunos = Aluno::count();
        $totalMatriculas = Matricula::count();
        $mensalidadesPagas = Mensalidade::where('estado', 'pago')->count();
        $mensalidadesPendentes = Mensalidade::where('estado', 'pendente')->count();
        $ultimosPagamentos = Pagamento::latest()->take(1)->get();

        return view('escola.admin.admin.dashboard.dashboard', compact(
            'totalAlunos',
            'totalMatriculas',
            'mensalidadesPagas',
            'mensalidadesPendentes',
            'ultimosPagamentos'
        ));
    }
}
