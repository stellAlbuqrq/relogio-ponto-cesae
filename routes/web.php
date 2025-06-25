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
use App\Http\Controllers\DisparoPinController;
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

//Rotas que passam pelo middleware CheckRole = aluno
Route::middleware(['auth', 'checkrole:aluno'])->group(function () {
    Route::get('/presenca', [PresencaController::class, 'presencaMostrar'])->name('aluno.presenca');
    Route::post('/presenca/checkin', [PresencaController::class, 'presencaCheckInGuardar'])->name('aluno.checkin');
    Route::post('/presenca/checkout', [PresencaController::class, 'presencaCheckOutGuardar'])->name('aluno.checkout');
});

//Rotas que passam pelo middleware CheckRole = formador
Route::middleware(['auth', 'checkrole:formador'])->group(function () {
    //Rota página do botão disparar PIN
    Route::get('/formador', [DisparoPinController::class, 'index'])->name('formador.index');
    Route::post('/pin', [DisparoPinController::class, 'dispararPin'])->name('formador.pin');

});

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
