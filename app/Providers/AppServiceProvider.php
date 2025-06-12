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
use App\Models\Conversation;
use App\Policies\ConversationPolicy;
use App\Http\ViewComposers\ConversationsComposer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;


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
        View::composer('chat.conversations.sidebar', ConversationsComposer::class);

         view()->composer('*', function ($view) {
        if (Auth::check()) {
            Cache::put('user-is-online-' . Auth::id(), true, now()->addMinutes(2));
        }
    });
        
    }

    protected $listen = [
    \App\Events\MensalidadePaga::class => [
        \App\Listeners\RegistrarReceitaMensalidade::class,
    ],
    \App\Events\SalarioPago::class => [
         \App\Listeners\RegistrarDespesaSalario::class,
    ],
];


    protected $policies = [
    Conversation::class => ConversationPolicy::class,
];

}
