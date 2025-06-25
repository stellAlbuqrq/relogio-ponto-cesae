<?php

use App\Http\Controllers\DisparoPinController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIp;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
    Route::get('/presenca', [PresencaController::class, 'presencaMostrar'])->name('aluno.presenca');
    Route::post('/presenca/checkin', [PresencaController::class, 'presencaCheckInGuardar'])->name('aluno.checkin');
    Route::post('/presenca/checkout', [PresencaController::class, 'presencaCheckOutGuardar'])->name('aluno.checkout');
    Route::get('/', [PresencaController::class, 'paginaInicial'])->name('aluno.pagina-inicial');
});

//Rotas que passam pelo middleware CheckRole = formador
Route::middleware(['auth', 'checkrole:formador'])->group(function () {
    //Rota página do botão disparar PIN
    Route::get('/formador', [DisparoPinController::class, 'index'])->name('formador.index');
    Route::post('/pin', [DisparoPinController::class, 'dispararPin'])->name('formador.pin');

});


Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');






require __DIR__ . '/auth.php';
