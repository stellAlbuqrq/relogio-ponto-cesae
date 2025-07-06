<?php

namespace App\Http\Controllers\Formador;


use App\Models\Cronograma;
use App\Models\Modulo;
use App\Services\CronogramaService;
use App\Services\PresencaService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FormadorDashboardController extends \App\Http\Controllers\Controller
{
    protected $cronogramaService;
    protected $presencaService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PresencaService $presencaService)
    {
        $this->cronogramaService = $cronogramaService;
        $this->presencaService = $presencaService;
    }

    public function formadorAulas()
    {

        //Seção dos Alunos sem CheckIn
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();
        $alunosSemCheckin = $this->presencaService->existeCheckIn($cronograma_id);

        //Seção do progresso do curso
        $formador_id = Auth::id();
        $hoje = Carbon::today();

        $formador_id = Auth::id();
        $hoje = Carbon::today();

        // Pega o módulo em curso no dia de hoje (o primeiro encontrado no cronograma)
        $moduloIdEmCurso = Cronograma::where('formador_id', $formador_id)
            ->whereDate('data', $hoje)
            ->value('modulo_id');

        if ($moduloIdEmCurso) {
            $modulo = Modulo::where('formador_id', $formador_id)
                ->where('id', $moduloIdEmCurso)
                ->select('id', 'nome', 'carga_horaria')
                ->first();

            // Calcula as horas já passadas (até ontem)
            $horasPassadas = Cronograma::where('modulo_id', $modulo->id)
                ->where('formador_id', $formador_id)
                ->whereDate('data', '<=', $hoje)
                ->sum('duracao');

            $modulo->horas_passadas = $horasPassadas;

            if ($modulo->carga_horaria > 0) {
                $percentual = ($horasPassadas / $modulo->carga_horaria) * 100;
                $modulo->percentual_concluido = min(round($percentual, 1), 100);
            } else {
                $modulo->percentual_concluido = 0;
            }

            $modulo->horas_restantes = max($modulo->carga_horaria - $horasPassadas, 0);

            if ($modulo->percentual_concluido >= 100) {
                $modulo->status = 'Completo';
                $modulo->status_color = '#10b981';
            } elseif ($modulo->percentual_concluido >= 75) {
                $modulo->status = 'Quase Completo';
                $modulo->status_color = '#f59e0b';
            } elseif ($modulo->percentual_concluido >= 50) {
                $modulo->status = 'Em Progresso';
                $modulo->status_color = '#6366f1';
            } else {
                $modulo->status = 'Início';
                $modulo->status_color = '#ef4444';
            }
        } else {
            // Nenhum módulo em curso hoje
            $modulo = null;
        }

        //Seção Cronograma
        $cronogramas = Cronograma::with(['modulo', 'formador'])->get();


        $cronogramaEventos = $cronogramas->map(function ($cronograma) {
            $startDateTime = $cronograma->data . 'T' . $cronograma->hora_inicio;
            $endDateTime = $cronograma->data . 'T' . $cronograma->hora_fim;
            return [
                'id'    => $cronograma->id,
                'title' => $cronograma->modulo->nome,
                'start' => $startDateTime,
                'end' => $endDateTime,
                'color' => '#f0ad4e'
            ];
        })->all();

        return view('formador.dashboard', compact(
            'alunosSemCheckin',
            'modulo',
            'cronogramaEventos'
        ));
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
