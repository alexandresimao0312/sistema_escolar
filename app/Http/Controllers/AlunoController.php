<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoRequest;
use App\Models\Avaliacao;
use App\Models\Classe;
use App\Models\Turma;
use App\Models\Curso;
use App\Models\Media;
use App\Models\Mensalidade;
use App\Models\Frequencia;
use App\Models\Matricula;
use Illuminate\Pagination\Paginator;
use App\Models\LogAtividade;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aluno::query();

        $alunos = $query->with(['matriculas' => function ($q) {
            $q->latest()->limit(1); // carrega só a matrícula mais recente se necessário
        }])->paginate(10)->withQueryString();
        
    
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }
    
        if ($request->filled('curso_id')) {
            $query->whereHas('matriculas.curso', function ($q) use ($request) {
                $q->where('id', $request->curso_id);
            });
        }
    
        if ($request->filled('classe_id')) {
            $query->whereHas('matriculas.classe', function ($q) use ($request) {
                $q->where('id', $request->classe_id);
            });
        }
    
        $alunos = $query->with('matriculas.curso')->paginate(8);
        $cursos = Curso::all();
        $classes = Classe::all();
    
        return view('escola.admin.secretaria.alunos.aluno', compact('alunos', 'cursos','classes'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('escola.admin.secretaria.alunos.alunoCriar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlunoRequest $request)
    {
        // 


      $aluno =  Aluno::create($request->all());

     

    // Após criar aluno, por exemplo:
    LogAtividade::create([
    'secretaria_id' => auth('secretaria')->id(),
    'acao' => 'Criou um novo aluno',
    'entidade_afetada' => 'aluno',
    'id_entidade' => $aluno->id,
    'detalhes' => 'Aluno cadastrado com nome: ' . $aluno->nome,
]);

        return redirect()->route('secretaria.alunos.create')->with('success', 'Aluno criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
    
      // $aluno = Aluno::findOrFail($aluno->id);
     $aluno = Aluno::with('matriculas.curso', 'matriculas.classe', 'matriculas.turma')->findOrFail($aluno->id);
      $matriculas = Matricula::with('curso', 'classe', 'turma')->findOrFail($aluno->id);
       
        return view('escola.admin.secretaria.alunos.alunoInf', compact('aluno','matriculas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aluno $aluno)
    {
        //
        $aluno = Aluno::findOrFail($aluno->id);
        return view('escola.admin.secretaria.alunos.alunoEdit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        //
        $aluno = Aluno::findOrFail($aluno->id);
        $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'nif' => 'required|string|min:6|max:16|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/|unique:alunos,nif,' . $aluno->id,
            'email'=> 'required|email|unique:alunos,email,'. $aluno->id,
        ]);

        
        $aluno->update($request->all());

         // Após editar aluno, por exemplo:
       LogAtividade::create([
        'secretaria_id' => auth('secretaria')->id(),
        'acao' => 'Atualizou um aluno',
        'entidade_afetada' => 'aluno',
        'id_entidade' => $aluno->id,
        'detalhes' => 'Aluno Atualizado com o nome: ' . $aluno->nome,
    ]);
        
        return redirect()->back()->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno)
    {
        //
        $aluno->delete();

         // Após Apagar aluno, por exemplo:
         LogAtividade::create([
        'secretaria_id' => auth('secretaria')->id(),
        'acao' => 'Apagou um aluno',
        'entidade_afetada' => 'aluno',
        'id_entidade' => $aluno->id,
        'detalhes' => 'Aluno Apagado com o nome: ' . $aluno->nome,
    ]);
        return redirect()->route('secretaria.alunos.index')->with('success', 'Aluno excluída com sucesso.');
    }

    public function gerarPdf($id)
{
    $aluno = Aluno::with('matriculas.curso', 'matriculas.classe', 'matriculas.turma')->findOrFail($id);
    
    $pdf = Pdf::loadView('escola.admin.secretaria.alunos.pdf', compact('aluno'));

    return $pdf->download("dados_aluno_{$aluno->nome}.pdf");
}
public function search(Request $request)
{
    $request->validate([
        'keyword' => 'required',
        'tipoDeBusca' => 'required',
    ]);
    
    $keyword = $request->input('keyword');
    $tipoDeBusca = $request->input('tipoDeBusca');

    $aluno = Aluno::where("{$tipoDeBusca}", 'LIKE', "%{$keyword}%")->paginate(4);
    
    return view('escola.admin.secretaria.alunos.alunoPesquisa', compact('aluno', 'keyword','tipoDeBusca'));
}
public function buscar(Request $request)
{
    // Aqui estamos buscando os alunos pelo nome com base no que foi digitado
    $termo = $request->input('q');
    $alunos = Aluno::where('nome', 'LIKE', "%{$termo}%")->get(['id', 'nome']);
    
    // Retornando a resposta em formato JSON
    return response()->json($alunos);
}

public function historico(Aluno $aluno)
{
    $matriculas = $aluno->matriculas()->with(['curso', 'mensalidades.pagamentos'])->get();

    return view('escola.admin.secretaria.alunos.historico', compact('aluno', 'matriculas'));
}


public function exportarHistoricoPDF($id)
{
    $aluno = Aluno::with([
        'matriculas.curso',
        'matriculas.mensalidades.pagamentos'
    ])->findOrFail($id);

    $pdf = Pdf::loadView('escola.admin.secretaria.alunos.historicoPdf', compact('aluno'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('historico_aluno_'.$aluno->nome.'.pdf');
}
public function exportarPDF()
{
    $alunos = Aluno::orderBy('nome')->get();

    $pdf = Pdf::loadView('escola.admin.secretaria.exports.alunos_pdf', compact('alunos'));
    return $pdf->download('lista_de_alunos.pdf');
}

}
