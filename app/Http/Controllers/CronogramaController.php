<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function mostrarCronograma(){

        return view('aluno.cronograma');
    }


//----------------- CARMEM ---------------------

//Mostra as aulas do dia
public function cronograma()
{
    $hoje = Carbon::today(); // data de hoje
    $cronogramahoje = Cronograma::with('modulo')
        ->whereDate('data', $hoje)
        ->get(); // pode retornar 2 aulas

    return view('aluno.dashboard', compact('cronogramahoje'));
}


}
