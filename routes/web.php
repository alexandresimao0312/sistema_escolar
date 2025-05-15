<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\MensalidadeController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotificacaoPaginaController;
use App\Http\Controllers\Secretaria\NotificacaoController as SecretariaNotificacaoController;
use App\Http\Controllers\Secretaria\PerfilController;
use App\Http\Controllers\SecretariaDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AjusteMensalidadeController;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Models\Pagamento;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;


Route::get('/login/opcao', function () {
    return view('auth.selecionar-login');
})->name('login.opcao');

Route::redirect('/', '/login/opcao');


   // Rotas do modulo Secretaria
Route::prefix('secretaria')->name('secretaria.')->group(function () {
    Route::get('login', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'login'])->middleware('throttle:5,1');;
    Route::post('logout', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'logout'])->name('logout');
    // garante que só secretaria logado tem acesso a essa routa.
    Route::middleware(['auth:secretaria'])->group(function () {
        Route::get('dashboard', [SecretariaDashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('/alunos', AlunoController::class);
        Route::resource('/matriculas', MatriculaController::class);
        Route::resource('/mensalidades', MensalidadeController::class);
        Route::resource('/pagamentos', PagamentoController::class);
        Route::get('/perfil', [PerfilController::class, 'edit'])->name('secretaria.perfil.edit');
        Route::put('/perfil', [PerfilController::class, 'update'])->name('secretaria.perfil.update');
        // Perfil - alteração de senha
        Route::get('/perfil/senha', [PerfilController::class, 'editarSenha'])->name('secretaria.perfil.senha.edit');
        Route::post('/perfil/senha', [PerfilController::class, 'atualizarSenha'])->name('secretaria.perfil.senha.update');
        Route::get('logs', [LogController::class, 'index'])
            ->name('secretaria.logs.index');
        Route::get('alunos/{aluno}/historico/pdf', [AlunoController::class, 'exportarHistoricoPDF'])->name('secretaria.alunos.historico.pdf');
        Route::get('/secretaria/alunos/{aluno}/historico', [AlunoController::class, 'historico'])->name('secretaria.alunos.historico');
        Route::get('notificacoes', [NotificacaoPaginaController::class, 'index'])->name('secretaria.notificacoes.index');
    });

    });

// Rotas do modulo Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('login', [LoginController::class, 'login'])->name('login')->middleware('throttle:5,1');;
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // garante que só admin logado tem acesso a essa routa.
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('admin.dashboard');
        Route::resource('secretarias', App\Http\Controllers\Admin\SecretariaController::class);
        Route::post('secretarias/{id}/ativar', [App\Http\Controllers\Admin\SecretariaController::class, 'ativarOuDesativar'])->name('secretarias.ativar');
        Route::resource('turmas', TurmaController::class);
        Route::resource('cursos', CursoController::class);
        Route::patch('/cursos/{id}/toggle-status', [CursoController::class, 'toggleStatus'])->name('admin.cursos.toggle-status');
        Route::resource('classes', ClasseController::class);
        Route::resource('ajustes', AjusteMensalidadeController::class);
        Route::post('/mensalidades/{id}/pagar', [MensalidadeController::class, 'pagar'])->name('mensalidades.pagar');
        Route::resource('administradores', AdminController::class)->names('admin.admins');

    });
});
// rotas do modulo do professor
Route::prefix('professor')->group(function () {
    // garante que so professor logado tenha acesso
    Route::middleware(['professor'])->group(function () {

    });
});
// rotas do modulo do Aluno
Route::prefix('professor')->group(function () {
    // garante que so Aluno logado tenha acesso
    Route::middleware(['aluno'])->group(function () {

    });
});


    // Route Normais Para O Funcionamento Do Sistema

    Route::resource('/documentos', DocumentoController::class);
    // Route de Gerar PDF 
    Route::get('/alunos/{id}/pdf', [AlunoController::class, 'gerarPdf'])->name('alunos.pdf');
    Route::get('/pagamentos/{id}/comprovativo', [PagamentoController::class, 'comprovativo'])->name('pagamentos.comprovativo');
    Route::get('mensalidades/{id}/comprovativo', [MensalidadeController::class, 'gerarComprovativo'])->name('mensalidades.comprovativo');
    Route::get('/mensalidades/exportar/pdf', [MensalidadeController::class, 'exportarPDF'])->name('secretaria.mensalidades.exportar.pdf');
    Route::get('/pagamentos/exportar/pdf', [PagamentoController::class, 'exportarPDF'])->name('secretaria.pagamentos.exportar.pdf'); 
    Route::get('/alunos/exportar/pdf', [AlunoController::class, 'exportarPDF'])->name('secretaria.alunos.exportar.pdf');
    Route::get('/matriculas/exportar/pdf', [MatriculaController::class, 'exportarPdf'])->name('matriculas.exportar.pdf');

    // Route de Pesquisas no Sistema
    Route::get('/search/alunos', [AlunoController::class, 'search'])->name('alunos.search');
    Route::get('/search/mensalidades', [MensalidadeController::class, 'search'])->name('mensalidades.search');
    Route::get('/search/pagamentos', [PagamentoController::class, 'search'])->name('pagamentos.search');
    Route::get('/search/matriculas', [MatriculaController::class, 'search'])->name('matriculas.search');
    Route::get('/alunos/buscar', [AlunoController::class, 'buscar'])->name('alunos.buscar');
    Route::get('/secretaria/mensalidade/buscar', [MensalidadeController::class, 'buscar'])->name('secretaria.matriculas.buscar');
    Route::get('/secretaria/matricula/buscar', [MatriculaController::class, 'buscar'])->name('secretaria.alunos.buscar');
    Route::get('/mensalidades/das-dividas/{alunoId}', [MensalidadeController::class, 'buscarDividas']);

    // Routas para selecionar Automaticamento As classe e turmas de acordo com o curso
    Route::get('/classes/por-curso/{curso_id}', [ClasseController::class, 'porCurso']);
    Route::get('/turmas/por-curso-e-classe/{curso_id}/{classe_id}', [TurmaController::class, 'porCursoEClasse']);
    Route::get('/admin/classes-por-curso/{curso}', [AjusteMensalidadeController::class, 'classesPorCurso'])->name('admin.classes.porCurso');

    // outras routas
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/cursos', [CursoController::class, 'list'])->name('cursos.list');
    Route::get('/turmas', [TurmaController::class, 'list'])->name('turmas.list');
    Route::get('/classes', [classeController::class, 'list'])->name('classes.list');



 Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

