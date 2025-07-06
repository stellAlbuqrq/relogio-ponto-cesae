<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Models\Modulo;
use App\Services\CronogramaService;
use App\Services\PresencaService;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CronogramaController extends Controller
{
    protected $cronogramaService;
    protected $presencaService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PresencaService $presencaService)
    {
        $this->cronogramaService = $cronogramaService;
        $this->presencaService = $presencaService;
    }

    public function mostrarCronograma()
    {

        return view('aluno.aulas-dia');
    }

public function cronograma(Request $request)
    {
        $aluno_id = Auth::id();
        $hoje = Carbon::today();

        $siglasModulos = [
            'Programação em SQL' => 'SQL',
            'Programação - Algoritmos' => 'ALG',
            'Engenharia de Software' => 'ENG',
            'Bases de dados - conceitos' => 'BD',
            'Programação de computadores - estruturada' => 'PC-EST',
            'Programação de computadores - orientada a objetos' => 'PC-POO',
            'Programação para a WEB - cliente (client side)' => 'WEB-C',
            'WEB - hipermédia e acessibilidades' => 'WEB-A',
            'WEB - ferramentas multimédia' => 'WEB-M',
            'Programação para a WEB - servidor (server side)' => 'WEB-S',
            'Integração de sistemas de informação - conceitos' => 'ISI-C',
            'Integração de sistemas de informação - tecnologias e níveis de Integração' => 'ISI-T',
            'Integração de sistemas de informação - ferramentas' => 'ISI-F',
            'Acesso móvel a sistemas de informação' => 'MOV',
            'Projeto de tecnologias e programação de sistemas de informação' => 'PROJ',
            'Desenvolvimento de Aplicações Mobile' => 'MOB',
            'Inglês técnico aplicado às telecomunicações' => 'ING',
            'Comunicação assertiva e técnicas de procura de emprego' => 'COM',
        ];

        // Seção Aulas do dia
        $aulas = Cronograma::whereDate('data', $hoje)
            ->with(['modulo', 'formador'])
            ->get();

        // Seção Chart de Presenças e Faltas por módulo
        $modulos = Modulo::with(['cronogramas.presencas' => function ($query) use ($aluno_id) {
            $query->where('aluno_id', $aluno_id);
        }])
            ->select('id', 'nome', 'carga_horaria')
            ->get();

        $dadosChart = [];
        $categoriasModulos = [];
        $dadosPresenca = [];
        $dadosFalta = [];

        foreach ($modulos as $modulo) {
            // Filtrar cronogramas até hoje (aulas já realizadas)
            $cronogramas_ate_hoje = $modulo->cronogramas->filter(function ($cronograma) use ($hoje) {
                return Carbon::parse($cronograma->data)->lte($hoje);
            });

            // Pegar total de cronogramas do módulo (aulas programadas)
            $totalAulasProgramadas = $modulo->cronogramas->count();

            if ($cronogramas_ate_hoje->isEmpty() || $totalAulasProgramadas == 0) {
                continue;
            }

            $totalAulasRealizadas = $cronogramas_ate_hoje->count();

            // Contar presenças
            $presencas = 0;
            foreach ($cronogramas_ate_hoje as $cronograma) {
                if ($cronograma->presencas->isNotEmpty()) {
                    $presencas++;
                }
            }

            // Faltas são apenas as aulas realizadas onde o aluno faltou
            $faltas = $totalAulasRealizadas - $presencas;

            // Calcular percentuais baseados no total de aulas programadas
            $percentualPresenca = $totalAulasProgramadas > 0 ? round(($presencas / $totalAulasProgramadas) * 100, 1) : 0;
            $percentualFalta = $totalAulasProgramadas > 0 ? round(($faltas / $totalAulasProgramadas) * 100, 1) : 0;

            // Percentual do curso já realizado
            $percentualRealizado = $totalAulasProgramadas > 0 ? round(($totalAulasRealizadas / $totalAulasProgramadas) * 100, 1) : 0;

            $sigla = $siglasModulos[$modulo->nome] ?? $modulo->nome;

            $categoriasModulos[] = $sigla;
            $dadosPresenca[] = $percentualPresenca;
            $dadosFalta[] = $percentualFalta;

            $dadosChart[] = [
                'modulo' => $sigla,
                'carga_horaria' => $modulo->carga_horaria,
                'total_aulas_programadas' => $totalAulasProgramadas,
                'aulas_realizadas' => $totalAulasRealizadas,
                'presencas' => $presencas,
                'faltas' => $faltas,
                'percentual_presenca' => $percentualPresenca,
                'percentual_falta' => $percentualFalta,
                'percentual_realizado' => $percentualRealizado,
                'percentual_restante' => 100 - $percentualRealizado,
            ];
        }

        $dados = [
            'categorias' => $categoriasModulos,
            'dados_presenca' => $dadosPresenca,
            'dados_falta' => $dadosFalta,
            'detalhes' => $dadosChart
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'dados' => $dados
            ]);
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

        return view('aluno.dashboard', compact('aulas', 'dados', 'siglasModulos', 'cronogramaEventos'));
    }


    public function cronogramaAlunoMensalMostar()
    {
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
