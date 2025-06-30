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

        return view('aluno.aulas-dia');
    }

    public function cronograma()
    {
        $user = Auth::user(); // usuário logado
        $hoje = Carbon::today(); //Identifica o dia de hoje

        $aulas = Cronograma::whereDate('data', $hoje)
            ->with(['modulo', 'formador'])
            ->get();

        return view('aluno.dashboard', compact('aulas'));
    }


    public function formadorAulas()
    {
        $user = Auth::user();
        $hoje = Carbon::today();

        $aulas = Cronograma::where('formador_id', $user->id)
            ->whereDate('data', $hoje)
            ->with('modulo', 'formador', 'turma')
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

    public function cronogramaAlunoMensalMostar()
    {
        $cronogramas = Cronograma::with(['modulo', 'formador'])->get();

        $cronogramaEventos = $cronogramas->map(function ($cronograma) {
            // Concatena a data com a hora para formar o datetime completo
            $startDateTime = $cronograma->data . 'T' . $cronograma->hora_inicio;
            $endDateTime = $cronograma->data . 'T' . $cronograma->hora_fim;
            return [
                'id'    => $cronograma->id,
                'title' => $cronograma->modulo->nome, // O nome do evento
                'start' => $startDateTime,
                'end' => $endDateTime,
                // Adicione outras propriedades se desejar, como 'color'
                'color' => '#f0ad4e' // Exemplo de cor para este evento
            ];
        })->all(); // Converte a coleção para um array simples
        return view('aluno.cronograma', compact('cronogramaEventos'));
    }

    public function eventos(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        $cronogramas = Cronograma::with(['modulo', 'turma'])
            ->whereBetween('data', [$start, $end])
            ->get();

        $events = $cronogramas->map(function ($c) {
            return [
                'id' => $c->id,
                'title' => $c->modulo->nome ?? 'Módulo',
                'start' => $c->data . 'T' . substr($c->hora_inicio, 0, 5),
                'end' => $c->data . 'T' . substr($c->hora_fim, 0, 5),
                'resourceId' => $c->turma_id,
            ];
        });

        return response()->json($events);
    }
}
