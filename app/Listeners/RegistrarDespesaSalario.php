<?php

namespace App\Listeners;

use App\Events\SalarioPago;
use App\Models\Caixa;
use App\Models\Despesa;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistrarDespesaSalario
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
   public function handle(SalarioPago $event)
    {
        $salario = $event->salario;

      $despesas =  Despesa::create([
            'observacoes' => 'Pagamento de salário ao funcionário: ' . $salario->funcionario->nome,
            'valor' => $salario->total_recebido,
            'data' => now(),
            'tipo' => 'Salário',
        ]);

        // Atualiza o caixa
        Caixa::create([
            'descricao' => 'Pagamento de salário Codigo da Despesa Número: ' . $despesas->id,
            'valor' => $despesas->valor,
            'data' => now(),
            'tipo' => 'saida',
           
        ]);
    }
}
