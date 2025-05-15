<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Models\Pagamento;
use App\Models\Turma;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();

        $totalAlunos = Aluno::count();
        view()->share('totalAlunos', $totalAlunos);
        $totalMatriculas = Matricula::count();
        view()->share('totalMatriculas', $totalMatriculas);
        $mensalidadesPagas = Mensalidade::where('estado', 'pago')->count();
        view()->share('mensalidadesPagas', $mensalidadesPagas);
        $mensalidadesPendentes = Mensalidade::where('estado', 'pendente')->count();
        view()->share('mensalidadesPendentes', $mensalidadesPendentes);
         $turmaTotal = Turma::count();
        view()->share('turmaTotal', $turmaTotal);
        
    }
}
