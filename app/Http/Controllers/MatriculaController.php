<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NotificacaoMatricula;
use Illuminate\Support\Facades\Notification;
use App\Models\Turma;
use App\Http\Requests\MatriculaRequest;
use App\Models\Mensalidade;
use App\Console\Commands\GerarMensalidadesMensais;
use Illuminate\Support\Carbon;
use App\Models\LogAtividade;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\NovoAlunoMatriculado;
use App\Models\AjusteMensalidade;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    $query = Matricula::with(['aluno', 'curso', 'classe', 'turma']);

    if ($request->filled('id')) {
        $query->where('id', $request->id);
    }

    if ($request->filled('curso_id')) {
        $query->where('curso_id', $request->curso_id);
    }

    if ($request->filled('classe_id')) {
        $query->where('classe_id', $request->classe_id);
    }

    if ($request->filled('turma_id')) {
        $query->where('turma_id', $request->turma_id);
    }

    $matriculas = $query->paginate(8);

    $cursos  = Curso::all();
    $classes = Classe::all();
    $turmas  = Turma::all();

    return view('escola.admin.secretaria.matriculas.matricula', compact('matriculas', 'cursos', 'classes', 'turmas'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        $alunos = Aluno::all();
        $cursos = Curso::all();
        $classes = Classe::all();
        $turmas = Turma::all();
        return view('escola.admin.secretaria.matriculas.matriculaCriar', compact('alunos', 'cursos', 'classes', 'turmas'));
    
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatriculaRequest $request)
    {

        
      // Extrair o ano da data de matrícula
    $ano = Carbon::parse($request->data_matricula)->format('Y');

     // Verificar se já existe matrícula para este aluno, curso e ano
     $existe = Matricula::where('aluno_id', $request->aluno_id)
     ->where('curso_id', $request->curso_id)
     ->whereYear('data_matricula', $ano)
     ->exists();

     // Verificar o estado do curso antes de fazer uma matricula
     $curso = Curso::findOrFail($request->curso_id);
     if (!$curso->ativo) {
        return back()->withErrors(['curso_id' => 'Não é possível matricular neste curso, pois ele está desativado.']);
    }
      // Verificar os numeros de alunos na turma, antes de inserir outro aluno
       $turma = Turma::withCount('matriculas')->findOrFail($request->turma_id);
      
    if ($turma->matriculas_count >= $turma->limite_alunos) {
        return redirect()->back()
            ->withErrors('errors', 'A turma "' . $turma->nome . '" atingiu o limite de ' . $turma->limite_alunos . ' alunos.');
    }
  

 if ($existe) {
     return back()->withErrors([
         'errors','Este aluno já está matriculado neste curso no ano ' . $ano . '.'
     ]);
 }

        $matricula = Matricula::create($request->all());

        // trabalhando com as notificação

        $aluno = Aluno::findOrFail($request->aluno_id);
        $curso = Curso::findOrFail($request->curso_id);
        $classe = Classe::findOrFail($request->classe_id);
        $turma = Turma::findOrFail($request->turma_id);

        // Enviar e-mail para o aluno
       // $aluno = Aluno::find($request->aluno_id);
       // if ($aluno && $aluno->email) {
        //    $aluno->notify(new NotificacaoMatricula($matricula,$aluno,$curso,$classe,$turma));
        //    }

       // ✅ Gera mensalidades automáticas
      $this->gerarMensalidades($matricula);

      // Após criar matricula, por exemplo:
      LogAtividade::create([
        'secretaria_id' => auth('secretaria')->id(),
        'acao' => 'Criou uma Matricula',
        'entidade_afetada' => 'matricula',
        'id_entidade' => $matricula->id,
        'detalhes' => 'Matricula Criada Do Aluno: ' . $matricula->aluno_id,
    ]);
    $secretarias = \App\Models\Secretaria::all();

    foreach ($secretarias as $secretaria) {
    $secretaria->notify(new NovoAlunoMatriculado($aluno));
}


        return redirect()->route('secretaria.matriculas.index')->with('success', 'Matrícula criada e mensalidades geradas!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        //
        $matricula = Matricula::with('aluno', 'curso', 'classe')->findOrFail($matricula);
        return view('escola.admin.secretaria.matriculas.matriculaInf', compact('matricula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matricula $matricula)
    {
        //
       
        $alunos = Aluno::all();
        $cursos = Curso::all();
        $classes = Classe::all();
        $turmas = Turma::all();

        return view('escola.admin.secretaria.matriculas.matriculaEdit', compact('matricula', 'alunos', 'cursos', 'classes', 'turmas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
    
        $matricula = Matricula::findOrFail($matricula->id);
        $ano = Carbon::parse($request->data_matricula)->format('Y');
    
        $existe = Matricula::where('aluno_id', $request->aluno_id)
            ->where('curso_id', $request->curso_id)
            ->whereYear('data_matricula', $ano)
            ->where('id', '!=', $matricula->id) // Ignorar a matrícula atual
            ->exists();
    
        if ($existe) {
        session()->flash("errors",'Este aluno já está matriculado neste curso no ano ' . $ano . '.');
        return redirect()->back();
        }

         // Verificar os numeros de alunos na turma, antes de inserir outro aluno
        $turma = Turma::withCount('matriculas')->findOrFail($request->turma_id);

        if ($turma->matriculas_count >= $turma->limite_alunos) {
            return back()->with('errors', '🚫 A turma selecionada atingiu o limite máximo de alunos. Por favor, escolha outra turma.')->withInput();
        }
        $matricula->update([
            'aluno_id' => $request->aluno_id,
            'curso_id' => $request->curso_id,
            'data_matricula' => $request->data_matricula,
        ]);

        // Log de actividades:
        LogAtividade::create([
            'secretaria_id' => auth('secretaria')->id(),
            'acao' => 'Atualizou uma Matricula',
            'entidade_afetada' => 'matricula',
            'id_entidade' => $matricula->id,
            'detalhes' => 'Matricula Atualizada Do Aluno: ' . $matricula->aluno_id,
        ]);

        return redirect()->route('secretaria.matriculas.edit')->with('success', 'Matrícula atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        //
             $matricula = Matricula::with('mensalidades')->findOrFail($matricula->id);

            $hasPagas = $matricula->mensalidades->contains(function ($mensalidade) {
                return $mensalidade->estado === 'pago';
            });

            if ($hasPagas) {
            return redirect()->back()->withErrors(['errors' => 'Não é possível excluir uma matrícula com mensalidades pagas.']);
    }
        $matricula->delete();

          // Após criar matricula, por exemplo:
          LogAtividade::create([
            'secretaria_id' => auth('secretaria')->id(),
            'acao' => 'Apagou uma Matricula',
            'entidade_afetada' => 'matricula',
            'id_entidade' => $matricula->id,
            'detalhes' => 'Matricula Apagada Do Aluno: ' . $matricula->aluno_id,
        ]);
        return redirect()->route('secretaria.matriculas.index')->with('success', 'Matricula excluída com sucesso.');
    }

    private function gerarMensalidades($matricula, $totalMeses = 10)
    {
        // Busca o ajuste
        $ajuste = AjusteMensalidade::where('curso_id', $matricula->curso_id)
            ->where('classe_id', $matricula->classe_id)
            ->first();

      // Se houver ajuste, usa ele. Senão, usa valor do curso
    $valorMensalidade = $ajuste ? $ajuste->ajuste : $matricula->curso->valor_mensalidade;

      //  $valorMensalidade = $matricula->curso->valor_mensalidade ?? 25000;
        $dataInicio = now();
        $meses = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
             'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];
    
        for ($i = 0; $i < $totalMeses; $i++) {
            $data = $dataInicio->copy()->day(15); // ou configurable
            $mesNome = $meses[(int) $data->format('m') - 1];
            $ano = $data->format('Y');
    
            // Verifica se já existe mensalidade com mesmo mês, ano e matrícula
            $existe = Mensalidade::where('matricula_id', $matricula->id)
                ->where('mes', $mesNome)
                ->where('ano', $ano)
                ->exists();
    
            if (!$existe) {
                Mensalidade::create([
                    'matricula_id' => $matricula->id,
                    'mes' => $mesNome,
                    'ano' => $ano,
                    'valor' => $valorMensalidade,
                    'estado' => 'pendente',
                    'data_vencimento' => $data->copy()->day(10),
                ]);
            }
        }
    }
        public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
            'tipoDeBusca' => 'required',
        ]);
        
        $keyword = $request->input('keyword');
        $tipoDeBusca = $request->input('tipoDeBusca');

        $mensalidade = Aluno::where("{$tipoDeBusca}", 'LIKE', "%{$keyword}%")->paginate(4);
        dd($mensalidade);
        
        return view('escola.admin.secretaria.alunos.alunoPesquisa', compact('aluno', 'keyword','tipoDeBusca'));
    }

    // metodo de busca utilizando Ajax pra trazer as turma e classes de acordo o curso
    public function getClasses($cursoId)
    {
        $classes = Classe::where('curso_id', $cursoId)->get();
        return response()->json($classes);
    }
    
    public function getTurmas($cursoId)
    {
        $turmas = Turma::where('curso_id', $cursoId)->get();
        return response()->json($turmas);
    }

    public function buscar(Request $request)
{
    $termo = $request->get('q', '');
    
    $alunos = \App\Models\Aluno::where('nome', 'like', '%' . $termo . '%')
        ->select('id', 'nome')
        ->limit(20)
        ->get();

    $formatado = $alunos->map(function ($aluno) {
        return ['id' => $aluno->id, 'text' => $aluno->nome];
    });

    return response()->json(['results' => $formatado]);
}

public function exportarPdf(Request $request)
{
    
    $query = Matricula::with(['aluno', 'curso', 'classe', 'turma']);

    if ($request->filled('curso_id')) {
        $query->where('curso_id', $request->curso_id);
    }

    if ($request->filled('classe_id')) {
        $query->where('classe_id', $request->classe_id);
    }

    if ($request->filled('turma_id')) {
        $query->where('turma_id', $request->turma_id);
    }

    $matriculas = $query->get();

    $pdf = Pdf::loadView('escola.admin.secretaria.exports.pdf', compact('matriculas'));

    return $pdf->download('lista_matriculas.pdf');
}

}
