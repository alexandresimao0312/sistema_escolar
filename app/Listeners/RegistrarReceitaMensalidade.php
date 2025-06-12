<?php

namespace App\Listeners;

use App\Events\MensalidadePaga;
use App\Models\Caixa;
use App\Models\Receita;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistrarReceitaMensalidade
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
public function handle(MensalidadePaga $event)
    {
        $mensalidade = $event->pagamento;

       $receitas = Receita::create([
            'observacoes' => 'Pagamento de mensalidade do aluno: ' . $mensalidade->matricula->aluno->nome,
            'valor' => $mensalidade->valor_pago,
            'data' => now(),
            'tipo' => 'Mensalidade',
        ]);

        // Atualiza o caixa
          Caixa::create([
            'descricao' => 'Lucros Da Empresa Codigo da Receita Número: ' . $receitas->id,
            'valor' => $receitas->valor,
            'data' => now(),
            'tipo' => 'entrada',
           
        ]);
    }
}
