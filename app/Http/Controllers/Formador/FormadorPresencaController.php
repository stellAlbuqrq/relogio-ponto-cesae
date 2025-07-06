<?php

namespace App\Http\Controllers\Formador;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use App\Services\CronogramaService;
use App\Services\PinService;
use Illuminate\Http\Request;
use App\Services\PresencaService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FormadorPresencaController extends Controller
{
  protected $presencaService;

public function __construct(PresencaService $presencaService)
{
    $this->presencaService = $presencaService;
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Método que mostra todo o histórico de checkIn/checkOut
    public function presencaHistorico(Request $request)
{
    $formadorId = Auth::id();

      $filtros = [
        'data_inicio' => $request->input('data_inicio'),
        'data_fim' => $request->input('data_fim'),
        'modulo_id' => $request->input('modulo_id'),
        'aluno_nome' => $request->input('aluno_nome'),
        'status' => $request->input('status'),
    ];

$historico = $this->presencaService->historicoFormador($filtros);

    // Listar apenas módulos que pertencem ao formador autenticado
    $modulos = Modulo::where('formador_id', $formadorId)->get();

    return view('formador.presencas.presencas', compact('historico', 'modulos'));
}
public function atualizarPresenca(Request $request)
{
    $request->validate([
        'presenca_id' => 'required|exists:presencas,id',
        'check_in' => 'nullable|date_format:H:i',
        'check_out' => 'nullable|date_format:H:i',
        'comentario' => 'required|string|max:255',
    ]);

    $this->presencaService->atualizarPresenca($request->all());

    return redirect()->route('formador.presencas')->with('success', 'Presença atualizada com sucesso.');
}

//Verificar o status de ocorrência do módulo e as frequências dos alunos
    public function presencaModulo()
    {
        $formador_id = Auth::id();
        $hoje = Carbon::today();

        $modulos = Modulo::with('cronogramas.presencas.aluno')
            ->where('formador_id', $formador_id)
            ->select('id', 'nome', 'carga_horaria')
            ->get();

        foreach ($modulos as $modulo) {
    // Cronogramas até hoje
    $cronogramas_ate_hoje = $modulo->cronogramas->filter(fn($c) => Carbon::parse($c->data)->lte($hoje));

    $totalAulasModulo = $modulo->cronogramas->count();

    // Soma da duração das aulas até hoje
    $horasPassadas = $cronogramas_ate_hoje->sum('duracao');
    $modulo->horas_passadas = $horasPassadas;

    // Percentual concluído
    $modulo->percentual_concluido = $modulo->carga_horaria > 0
        ? min(round(($horasPassadas / $modulo->carga_horaria) * 100, 1), 100)
        : 0;

    $modulo->horas_restantes = max($modulo->carga_horaria - $horasPassadas, 0);

    // Status baseado no percentual
    $percentual = $modulo->percentual_concluido;
    if ($percentual >= 100) {
        $modulo->status = 'Completo';
        $modulo->status_color = '#10b981';
    } elseif ($percentual >= 75) {
        $modulo->status = 'Quase Completo';
        $modulo->status_color = '#f59e0b';
    } elseif ($percentual >= 50) {
        $modulo->status = 'Em Progresso';
        $modulo->status_color = '#6366f1';
    } else {
        $modulo->status = 'Início';
        $modulo->status_color = '#ef4444';
    }


    $alunos = [];
    foreach ($cronogramas_ate_hoje as $cronograma) {
        foreach ($cronograma->presencas as $presenca) {
            $alunos[$presenca->aluno->id] = $presenca->aluno;
        }
    }

    $totalAulas = $cronogramas_ate_hoje->count();
    $alunosPresenca = [];

    foreach ($alunos as $alunoId => $aluno) {
        $presencas = 0;

        foreach ($cronogramas_ate_hoje as $cronograma) {
            if ($cronograma->presencas->contains('aluno_id', $alunoId)) {
                $presencas++;
            }
        }

        $faltas = $totalAulas - $presencas;

        $percent_presenca = $totalAulasModulo > 0 ? round(($presencas / $totalAulasModulo) * 100) : 0;
        $percent_falta = $totalAulasModulo > 0 ? round(($faltas / $totalAulasModulo) * 100) : 0;
        $percent_restante = max(0, 100 - ($percent_presenca + $percent_falta));


        $soma = $percent_presenca + $percent_falta + $percent_restante;
        if ($soma !== 100) {
            $percent_restante += 100 - $soma;
        }

        $alunosPresenca[] = [
            'nome' => $aluno->nome,
            'presenca' => $percent_presenca,
            'falta' => $percent_falta,
            'restante' => $percent_restante,
        ];
    }

    $modulo->alunosPresenca = $alunosPresenca;
}

        return view('formador.presencas.presencas-modulo', compact('modulos'));
    }
}
