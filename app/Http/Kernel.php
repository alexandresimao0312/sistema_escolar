<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Message;
use App\Policies\MessagePolicy;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Comando agendado para gerar mensalidades todo dia 1 às 01:00
        $schedule->command('mensalidades:gerar')->monthlyOn(1, '01:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
   protected $routeMiddleware = [
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'secretaria' => \App\Http\Middleware\SecretariaMiddleware::class,
    'professor' => \App\Http\Middleware\ProfessorMiddleware::class,
    'aluno' => \App\Http\Middleware\AlunoMiddleware::class,
    '2fa' => \App\Http\Middleware\TwoFactorMiddleware::class,
    'last_seen' => \App\Http\Middleware\UpdateLastUserActivity::class,
     'web' => [
        \App\Http\Middleware\SetSessionCookieByGuard::class,
        // outros middlewares
    ],

];

protected $policies = [
    Message::class => MessagePolicy::class,
];


    protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\SetSessionCookieByGuard::class, // <= aqui
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // ...
    ],
];


    
}
