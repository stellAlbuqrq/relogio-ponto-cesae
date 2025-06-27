<?php

namespace App\Http\Controllers\Formador;

use App\Http\Controllers\Controller;
use App\Models\Cronograma;
use Illuminate\Http\Request;

class FormadorCronogramaController extends Controller
{
    public function index()
    {
         $cronogramas = Cronograma::with(['modulo','formador'])->get();


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
        return view('formador.cronogramas.index', compact('cronogramaEventos'));
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
