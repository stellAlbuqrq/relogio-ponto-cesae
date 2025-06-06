<?php

use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIp;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

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

//Rotas que passam pelo middleware CheckRole = aluno e sem seguinda middleware CheckIp
Route::middleware(['auth', CheckRole::class . ':admin,formador', CheckIp::class])->group(function () {
    Route::get('/presenca', [PresencaController::class, 'presencaMostrar'])->name('alunos.presenca');        //Mostra view com os dados de picagem: data/hora/aluno/módulo/botão "Picagem"
    Route::post('/presenca', [PresencaController::class, 'presencaGuardar'])->name('alunos.guardar');        //Guarda os dados de presença, ou seja, cria uma isntancia Presenca
});






require __DIR__ . '/auth.php';
