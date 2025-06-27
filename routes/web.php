<?php

use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\DisparoPinController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIp;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rotas que passam pelo middleware CheckRole = aluno
Route::middleware(['auth', 'checkrole:aluno'])->group(function () {
    //dashboard aluno
    // Route::get('/aluno', function () {
    //     return view('aluno.index');
    // })->name('aluno.dashboard');

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
    //Rota justificacoes de falta
    Route::get('presenca/justificacoes', [PresencaController::class, 'justificarFaltas'])->name('aluno.justificacoes');
    //Rota cronograma
    Route::get('/aluno/cronograma', [CronogramaController::class, 'mostrarCronograma'])->name('aluno.cronograma');
    //Rota para histórico
    Route::get('/presenca/historico', [PresencaController::class, 'presencaHistorico'])->name('aluno.historico');

    //Rota para a página inicial para mostrar as aulas do dia
    // Route::get('/aluno', [CronogramaController::class, 'cronograma']);


    // Route::get('/', [PresencaController::class, 'paginaInicial'])->name('aluno.pagina-inicial');

});

//Rotas que passam pelo middleware CheckRole = formador
Route::middleware(['auth', 'checkrole:formador'])->group(function () {
    //dashboard formador
    Route::get('formador', function () {
        return view('formador.dashboard');
    })->name('formador.dashboard');
    //Rota página que mostra info da aula e botão Disparar Pin
    Route::get('/pin', [DisparoPinController::class, 'mostrarPin'])->name('formador.pin');
    //Rota que guarda o disparo do pin
    Route::post('/dispararPin', [DisparoPinController::class, 'dispararPin'])->name('formador.disparo-pin');
    //Rota que mostra a duração do pin
    Route::get('/pin/duracao', function () {
        return view('formador.duracao-pin');
    })->name('formador.duracao-pin');
    //Rota cronograma
    // Route::get('/formador/cronograma', [CronogramaController::class, 'mostrarCronograma'])->name('formador.cronograma');
});




Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('login');






require __DIR__ . '/auth.php';
