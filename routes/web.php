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
use App\Http\Middleware\CheckIp;
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
     //Rota para histórico
    Route::get('/presenca/historico', [PresencaController::class, 'presencaHistorico'])->name('aluno.historico');

    //Rota justificacoes de falta
    Route::get('/justificacoes', [JustificarController::class, 'justificarFaltas'])->name('aluno.justificacoes');

    Route::post('/justificacoes/guardar', [JustificarController::class, 'justificarGuardar'])->name('aluno.justificacoes-guardar');

    //Rota cronograma
    Route::get('/aluno/cronograma', [CronogramaController::class, 'mostrarCronograma'])->name('aluno.cronograma');

});


//Rotas que passam pelo middleware CheckRole = formador
Route::middleware(['auth', 'checkrole:formador'])
    ->prefix('formador')
    ->name('formador.')
    ->group(function () {

    // Dashboard do Formador
    Route::get('/', function () {
        return view('formador.dashboard');
    })->name('dashboard');

    // Página que mostra info da aula e botão Disparar PIN
    Route::get('/pin', [DisparoPinController::class, 'mostrarPin'])->name('pin');

    // Ação que guarda o disparo do PIN
    Route::post('/disparar-pin', [DisparoPinController::class, 'dispararPin'])->name('disparo-pin');

    // Página que mostra a duração do PIN
    Route::get('/pin/duracao', function () {
        return view('formador.duracao-pin');
    })->name('duracao-pin');

    // CRUD convencional de Cronogramas
    Route::resource('cronogramas', FormadorCronogramaController::class);
    //Rota para histórico formador
   Route::get('/presencas', [FormadorPresencaController::class, 'presencaHistorico'])->name('presencas');

    //Rota para ver justificacoes dos alunos
    Route::get('/ver/justificacoes', [JustificarController::class, 'mostrarJustificacoes'])->name('formador.justificacoes');
    //Rota para aceitar e rejeitar justificacoes
    Route::post('/justificacoes/{justificacao}/aceitar', [JustificarController::class, 'aceitarJustificacoes'])->name('formador.justificacoes-aceitar');
    Route::post('/justificacoes/{justificacao}/rejeitar', [JustificarController::class, 'rejeitarJustificacoes'])->name('formador.justificacoes-rejeitar');

});


Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


//Rotas que passam pelo middleware CheckRole = admin
Route::middleware(['auth', 'checkrole:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {

    // Dashboard
    Route::get('/',           [AdminController::class,'dashboard'])->name('dashboard');
    Route::get('dashboard',   [AdminController::class,'index'])    ->name('index');

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
