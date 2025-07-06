<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrequenciaController extends Controller

    {
    public function index()
    {
        $alunoId = Auth::id();

        // Buscar todas as presenças do aluno
        $presencas = Presenca::with('cronograma.modulo')
            ->where('aluno_id', $alunoId)
            ->orderBy('created_at')
            ->get();

        // Agrupar por módulo (via cronograma)
        $presencasPorModulo = $presencas->groupBy(function ($presenca) {
            return optional($presenca->cronograma->modulo)->id;
        });

        $frequencias = $presencasPorModulo->map(function ($presencas, $moduloId) {
            // Agrupar por cronograma para cada módulo
            $porCronograma = $presencas->groupBy('cronograma_id');

            $totalHoras = 0;

            foreach ($porCronograma as $grupo) {
                $checkIn = $grupo->firstWhere('acao', 'check_in');
                $checkOut = $grupo->firstWhere('acao', 'check_out');

                if ($checkIn && $checkOut) {
                    $inicio = Carbon::parse($checkIn->created_at);
                    $fim = Carbon::parse($checkOut->created_at);

                    if ($fim->greaterThan($inicio)) {
                        $totalHoras += $inicio->diffInMinutes($fim) / 60;
                    }
                }
            }

            $modulo = optional($presencas->first()->cronograma->modulo);
            $horasTotal = $modulo->carga_horaria ?? 0;

            return [
                'modulo' => $modulo->nome ?? 'Desconhecido',
                'modulo_id' => $modulo->id ?? null,
                'carga_horaria' => $horasTotal,
                'horas_presenca' => round($totalHoras, 2),
                'horas_ausencia' => round($horasTotal - $totalHoras, 2),
            ];
        })->values();

        return view('aluno.frequencia', compact('frequencias'));
    }
}


