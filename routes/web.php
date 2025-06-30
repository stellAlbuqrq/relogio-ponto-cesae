<?php

use App\Http\Controllers\Admin\AdminCalendarController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCronogramaController;
use App\Http\Controllers\Admin\AdminCursoController;
use App\Http\Controllers\Admin\AdminModuloController;
use App\Http\Controllers\Admin\AdminPresencaController;
use App\Http\Controllers\Admin\AdminRelatorioController;
use App\Http\Controllers\Admin\AdminTurmaController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\DisparoPinController;
use App\Http\Controllers\Formador\FormadorCronogramaController;
use App\Http\Controllers\Formador\FormadorPresencaController;
use App\Http\Controllers\FormadorController;
use App\Http\Controllers\JustificarController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckRole;
use App\Models\Cronograma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');


//dashboard especifico dependendo do role
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Redireciona baseado no role
    switch ($user->role) {
        case 'aluno':
            return redirect()->route('aluno.dashboard');

        case 'formador':
            return redirect()->route('formador.dashboard');

        case 'admin':
            return redirect()->route('admin.dashboard');

        default:
            // Se não tiver role definido, logout
            Auth::logout();
            return redirect()->route('auth.login')->with('error', 'Role não definido');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rotas que passam pelo middleware CheckRole = aluno
Route::middleware(['auth', 'checkrole:aluno'])->group(function () {
    //dashboard aluno
    Route::get('/aluno', [CronogramaController::class, 'cronograma'])->name('aluno.dashboard');
    //Rotas para check-in
    Route::get('/presenca', [PresencaController::class, 'presencaMostrar'])->name('aluno.presenca');
    Route::post('/presenca/checkin', [PresencaController::class, 'presencaCheckInGuardar'])->name('aluno.checkin');
    //Rotas para check-out
    Route::get('/presenca/out', [PresencaController::class, 'presencaMostrarOut'])->name('aluno.presenca-out');
    Route::post('/presenca/checkout', [PresencaController::class, 'presencaCheckOutGuardar'])->name('aluno.checkout');
    //Rota check in manual -> sem PIN
    Route::get('presenca/checkin/manual', [PresencaController::class, 'presencaCheckInManual'])->name('aluno.checkin-manual');
    Route::post('presenca/manual/guardar', [PresencaController::class, 'presencaCheckInManualGuardar'])->name('aluno.checkin-manual-guardar');
    //Rota para histórico
    Route::get('/presenca/historico', [PresencaController::class, 'presencaHistorico'])->name('aluno.historico');

    // CRUD convencional de Cronogramas
    Route::get('aluno/cronograma', [CronogramaController::class, 'cronogramaAlunoMensalMostar'])->name('aluno.cronograma');

    //Rota justificacoes de falta
    Route::get('/justificacoes', [JustificarController::class, 'justificarFaltas'])->name('aluno.justificacoes');
    Route::post('/justificacoes/guardar', [JustificarController::class, 'justificarGuardar'])->name('aluno.justificacoes-guardar');

    //Rota cronograma
    Route::get('/aluno/aulas', [CronogramaController::class, 'mostrarCronograma'])->name('aluno.aulas-dia');
});


//Rotas que passam pelo middleware CheckRole = formador
Route::middleware(['auth', 'checkrole:formador'])->group(function () {

    //dashboard formador
    Route::get('/formador', [CronogramaController::class, 'formadorAulas'])->name('formador.dashboard');
    //Rota página que mostra info da aula e botão Disparar Pin
    Route::get('/pin', [DisparoPinController::class, 'mostrarPin'])->name('formador.pin');
    //Rota que guarda o disparo do pin
    Route::post('/dispararPin', [DisparoPinController::class, 'dispararPin'])->name('formador.disparo-pin');
    //Rota que mostra a duração do pin
    Route::get('/pin/duracao', function () {
        return view('duracao-pin');
    })->name('duracao-pin');
    //dashboard formador
    Route::get('/formador', [CronogramaController::class, 'formadorAulas'])->name('formador.dashboard');
    //Rota página que mostra info da aula e botão Disparar Pin
    Route::get('/pin', [DisparoPinController::class, 'mostrarPin'])->name('formador.pin');
    //Rota que guarda o disparo do pin
    Route::post('/dispararPin', [DisparoPinController::class, 'dispararPin'])->name('formador.disparo-pin');
    //Rota que mostra a duração do pin
    Route::get('/pin/duracao', function () {
        return view('duracao-pin');
    })->name('duracao-pin');

    // CRUD convencional de Cronogramas

    //Rota para cronograma fullcalendar
    Route::resource('cronogramas', FormadorCronogramaController::class);
    //Rota para histórico formador
    Route::get('/presencas', [FormadorPresencaController::class, 'presencaHistorico'])->name('formador.presencas');

    //Rota para ver justificacoes dos alunos
    Route::get('/ver/justificacoes', [JustificarController::class, 'mostrarJustificacoes'])->name('formador.justificacoes');
    //Rota para aceitar e rejeitar justificacoes
    Route::post('/justificacoes/{justificacao}/aceitar', [JustificarController::class, 'aceitarJustificacoes'])->name('formador.justificacoes-aceitar');
    Route::post('/justificacoes/{justificacao}/rejeitar', [JustificarController::class, 'rejeitarJustificacoes'])->name('formador.justificacoes-rejeitar');

    //Rota para atualização check-in check-out pelo formador
    Route::post('/presenca/atualizar', [FormadorPresencaController::class, 'atualizarPresenca'])->name('formador.presenca.atualizar');
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Rotas que passam pelo middleware CheckRole = admin
Route::middleware(['auth', 'checkrole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/',           [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('dashboard',   [AdminController::class, 'index'])->name('index');

        // CRUD Usuários / Cursos / Módulos / Turmas / Presenças
        Route::resource('usuarios',   AdminUserController::class);
        Route::resource('cursos',     AdminCursoController::class);
        Route::resource('modulos',    AdminModuloController::class);
        Route::resource('turmas',     AdminTurmaController::class);
        Route::resource('presencas',  AdminPresencaController::class)->except(['destroy']);

        // CRUD Cronogramas convencional
        Route::resource('cronogramas', AdminCronogramaController::class);
        // -> gera admin.cronogramas.index, create, store, show, edit, update, destroy


        // Visualização de presenças
        Route::get('presencas', [AdminPresencaController::class, 'index'])->name('presencas.index');

        // Relatórios
        Route::get('relatorios', [AdminRelatorioController::class, 'index'])->name('relatorios.index');
        Route::get('relatorios/presencas/csv', [AdminRelatorioController::class, 'exportarPresencasCSV'])->name('relatorios.presencas.csv');
        Route::get('relatorios/presencas/pdf', [AdminRelatorioController::class, 'exportarPresencasPDF'])->name('relatorios.presencas.pdf');
    });





require __DIR__ . '/auth.php';
