<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Mail\MensalidadeGeradaMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class GerarMensalidadesMensais extends Command
{
    protected $signature = 'mensalidades:gerar';
    protected $description = 'Gera mensalidades para o mês atual, para todas as matrículas';

    public function handle()
    {
        $dataAtual = Carbon::now();
        $mes = $dataAtual->format('m');
        $ano = $dataAtual->format('Y');

        $matriculas = Matricula::with('curso')->get();
       // $mensalidade = Mensalidade::with('matricula');

        foreach ($matriculas as $matricula) {
            $valor = $matricula->curso->valor_mensalidade ?? 25000;

            $existe = Mensalidade::where('matricula_id', $matricula->id)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->exists();

            if (!$existe) {
                Mensalidade::create([
                    'matricula_id' => $matricula->id,
                    'mes' => $mes,
                    'ano' => $ano,
                    'valor' => $valor,
                    'estado' => 'pendente',
                    'data_vencimento' => Carbon::now()->day(10),
                ]);

                $this->info("Mensalidade criada para matrícula ID {$matricula->id}");
                //Mail::to($matricula->aluno->email)->send(new MensalidadeGeradaMail($matricula->aluno, $mensalidade));
            }
        }

        return Command::SUCCESS;
    }
}

