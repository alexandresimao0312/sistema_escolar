<?php

use Illuminate\Support\Facades\Route;
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
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\SalarioController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\TwoFactorAdminController;
use App\Http\Controllers\Chat\ConversationController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\AjudaController;
use App\Http\Controllers\AjudaChatController;
use App\Http\Controllers\Admin\Finance\FinanceDashboardController;
use App\Http\Controllers\ConversationController as ControllersConversationController;
use App\Http\Controllers\TutorialAjudaController;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Mensalidade;
use App\Models\Pagamento;
use App\Models\Turma;

Route::get('/login/opcao', function () {
    return view('auth.selecionar-login');
})->name('login.opcao');

Route::redirect('/', '/login/opcao');



// Rotas do modulo Secretaria
Route::prefix('secretaria')->name('secretaria.')->group(function () {
    Route::middleware(['web'])->group(function () {
        Route::get('login', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'showLoginForm'])->name('login')->defaults('guard', 'secretaria');
        Route::post('login', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'login'])->middleware('throttle:5,1');;
        Route::post('logout', [App\Http\Controllers\Secretaria\Auth\LoginController::class, 'logout'])->name('logout');
    });

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
Route::prefix('admin')->middleware(['web'])->name('admin.')->group(function () {
    Route::middleware(['web'])->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form')->defaults('guard', 'admin');
        Route::post('login', [LoginController::class, 'login'])->name('login')->middleware('throttle:5,1');;
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

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
        Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
        Route::resource('funcionarios', App\Http\Controllers\FuncionarioController::class);
        Route::resource('salarios', SalarioController::class);

        Route::prefix('financeiro')->group(function () {
            Route::get('/admin/financeiro/dashboard', [FinanceDashboardController::class, 'index'])->name('admin.financeiro.dashboard');
        });

        // Route para criar tutorias de ajuda e suport
        Route::prefix('ajuda')->name('ajuda.')->controller(TutorialAjudaController::class)->group(function () {
            Route::get('/tutorial', 'index')->name('index');
            Route::get('/novo', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{tutorial}/editar', 'edit')->name('edit');
            Route::put('/{tutorial}/atualizar', 'update')->name('update');
            Route::delete('/{tutorial}/excluir', 'destroy')->name('destroy');
        });
    });
});
// rotas do modulo do professor
Route::prefix('professor')->group(function () {
    // garante que so professor logado tenha acesso
    Route::middleware(['professor'])->group(function () {});
});
// rotas do modulo do Aluno
Route::prefix('professor')->group(function () {
    // garante que so Aluno logado tenha acesso
    Route::middleware(['aluno'])->group(function () {});
});

// Lista todas as conversas do usuário autenticado modelo user
Route::prefix('chat')->group(function () {
    Route::get('/conversas', [ConversationController::class, 'index'])->name('chat.conversations.index');
    Route::get('/conversar', [ConversationController::class, 'create'])->name('chat.conversations.create');
    // Mostra uma conversa específica
    Route::get('/batepapo/{conversation}', [ConversationController::class, 'show'])->name('chat.conversations.show');
    Route::post('/conversar', [ConversationController::class, 'store'])->name('chat.conversations.store');
    Route::post('/messages/{conversation}', [MessageController::class, 'store'])->name('messages.store');
});
// Lista todas as conversas do usuário autenticado modelo Admin
Route::prefix('admin')->group(function () {
    Route::get('/batepapos', [ConversationController::class, 'indexAdmin'])->name('admin.chat.conversations.index');
    Route::get('/batepapo', [ConversationController::class, 'createAdmin'])->name('admin.chat.conversations.create');
    // Mostra uma conversa específica
    Route::get('/conversar/{conversation}', [ConversationController::class, 'showAdmin'])->name('admin.chat.conversations.show');
    Route::post('/batepapo', [ConversationController::class, 'storeAdmin'])->name('admin.chat.conversations.store');
    Route::post('/admin/messages/{conversation}', [MessageController::class, 'storeAdmin'])->name('admin.messages.store');
});
// Route de edit e destroy de uma mensagen
Route::prefix('chat/messages')->name('chat.messages.')->group(function () {
    Route::get('{message}/edit', [MessageController::class, 'edit'])->name('edit');
    Route::put('{message}', [MessageController::class, 'update'])->name('update');
    Route::delete('{message}', [MessageController::class, 'destroy'])->name('destroy');
});

// Route Normais Para O Funcionamento Do Sistema

// Route para criar tutorias de ajuda e suport
Route::prefix('ajuda')->name('ajuda.')->controller(TutorialAjudaController::class)->group(function () {
    Route::get('/tutorial', 'index')->name('index');
    Route::get('/novo', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{tutorial}/editar', 'edit')->name('edit');
    Route::put('/{tutorial}/atualizar', 'update')->name('update');
    Route::delete('/{tutorial}/excluir', 'destroy')->name('destroy');
});


// Route de Gerar PDF 
Route::get('/alunos/{id}/pdf', [AlunoController::class, 'gerarPdf'])->name('alunos.pdf');
Route::get('/pagamentos/{id}/comprovativo', [PagamentoController::class, 'comprovativo'])->name('pagamentos.comprovativo');
Route::get('mensalidades/{id}/comprovativo', [MensalidadeController::class, 'gerarComprovativo'])->name('mensalidades.comprovativo');
Route::get('/mensalidades/exportar/pdf', [MensalidadeController::class, 'exportarPDF'])->name('secretaria.mensalidades.exportar.pdf');
Route::get('/pagamentos/exportar/pdf', [PagamentoController::class, 'exportarPDF'])->name('secretaria.pagamentos.exportar.pdf');
Route::get('/alunos/exportar/pdf', [AlunoController::class, 'exportarPDF'])->name('secretaria.alunos.exportar.pdf');
Route::get('/matriculas/exportar/pdf', [MatriculaController::class, 'exportarPdf'])->name('matriculas.exportar.pdf');
Route::get('/salarios/{id}/recibo', [SalarioController::class, 'gerarRecibo'])->name('salarios.recibo');
Route::get('/recibo/verificar/{codigo}', [SalarioController::class, 'verificarRecibo'])->name('recibo.verificar');
Route::get('/verificar/recibo', [SalarioController::class, 'validarRecibo'])->name('recibo.validar');

// integração de IA/ chatgpt
Route::post('/ajuda/sugestao', [AjudaChatController::class, 'gerarSugestao'])->name('ajuda.ia');


// Route de Pesquisas no Sistema

Route::get('/search/mensalidades', [MensalidadeController::class, 'search'])->name('mensalidades.search');
Route::get('/search/pagamentos', [PagamentoController::class, 'search'])->name('pagamentos.search');
Route::get('/search/matriculas', [MatriculaController::class, 'search'])->name('matriculas.search');
Route::get('/alunos/buscar', [AlunoController::class, 'buscar'])->name('alunos.buscar');
Route::get('/secretaria/mensalidade/buscar', [MensalidadeController::class, 'buscar'])->name('secretaria.matriculas.buscar');
Route::get('/secretaria/matricula/buscar', [MatriculaController::class, 'buscar'])->name('secretaria.alunos.buscar');
Route::get('/mensalidades/das-dividas/{alunoId}', [MensalidadeController::class, 'buscarDividas']);
Route::get('/chat/usuarios-por-tipo', [\App\Http\Controllers\Chat\ConversationController::class, 'buscarUsuarios'])->name('chat.buscar.usuarios');


// Routas para selecionar Automaticamento As classe e turmas de acordo com o curso
Route::get('/classes/por-curso/{curso_id}', [ClasseController::class, 'porCurso']);
Route::get('/turmas/por-curso-e-classe/{curso_id}/{classe_id}', [TurmaController::class, 'porCursoEClasse']);
Route::get('/admin/classes-por-curso/{curso}', [AjusteMensalidadeController::class, 'classesPorCurso'])->name('admin.classes.porCurso');
Route::get('/funcionarios/buscar', [SalarioController::class, 'buscarFuncionarios'])->name('funcionarios.buscar');
Route::get('/secretaria/funcionarios/{id}/salario', function ($id) {
    $funcionario = \App\Models\Funcionario::findOrFail($id);
    return response()->json(['salario_base' => $funcionario->salario_base]);
});


// Routas de suport de ajuda do sistema.

Route::get('/ajuda', [AjudaController::class, 'index'])->name('ajuda.index');
Route::get('/ajuda/{tutorial}', [AjudaController::class, 'show'])->name('ajuda.show');



// outras routas
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/cursos', [CursoController::class, 'list'])->name('cursos.list');
Route::get('/turmas', [TurmaController::class, 'list'])->name('turmas.list');
Route::get('/classes', [classeController::class, 'list'])->name('classes.list');
Route::get('secretaria/2fa', [TwoFactorController::class, 'index'])->name('2fa.index');
Route::post('secretaria/2fa', [TwoFactorController::class, 'verify'])->name('2fa.verify');
Route::get('admin/2fa', [TwoFactorAdminController::class, 'index'])->name('admin.2fa.index');
Route::post('admin/2fa', [TwoFactorAdminController::class, 'verify'])->name('admin.2fa.verify');



Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
