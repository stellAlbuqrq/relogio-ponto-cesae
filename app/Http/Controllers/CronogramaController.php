<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CronogramaController extends Controller
{
    public function mostrarCronograma()
    {

        return view('aluno.cronograma');
    }

    public function cronograma()
    {
        $user = Auth::user(); // usuário logado
        $hoje = Carbon::today(); //Identifica o dia de hoje

        if ($user->role === 'formador') {
            // Redireciona para a view do formador com as aulas do dia dele
            $aulas = Cronograma::where('formador_id', $user->id)
                ->whereDate('data', $hoje)
                ->with('modulo')
                ->get();

            return view('formador.dashboard', compact('aulas'));
        }

        // Para aluno: todas as aulas do dia
        $aulas = Cronograma::whereDate('data', $hoje)
            ->with(['modulo', 'formador'])
            ->get();

        return view('aluno.dashboard', compact('aulas'));
    }


    public function formadorAulas()
{
    $user = Auth::user();
    $hoje = Carbon::today();

    // Verifica se é realmente um formador
    // if ($user->role !== 'formador') {
    //     abort(403, 'Acesso negado.');
    // }

    // Buscar aulas do formador logado
    $aulas = Cronograma::where('formador_id', $user->id)
                ->whereDate('data', $hoje)
                ->with('modulo')
                ->get();

    return view('formador.dashboard', compact('aulas'));
}



    ################## ALTERAR PARA SERVICE E REPOSITORY
    // public function cronograma()
    // {
    //     $hoje = Carbon::today(); // data de hoje
    //     $cronogramahoje = Cronograma::with('modulo')
    //         ->whereDate('data', $hoje)
    //         ->get(); // pode retornar 2 aulas

    //     return view('aluno.dashboard', compact('cronogramahoje'));
    // }
}
