<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cronograma;
use App\Models\Turma;

class AdminCronogramaController extends Controller
{
    public function index()
    {
        return view('admin.cronogramas.index');
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

    public function recursos()
    {
        $turmas = Turma::all();

        return response()->json($turmas->map(function ($t) {
            return [
                'id' => $t->id,
                'title' => $t->nome,
            ];
        }));
    }
}
