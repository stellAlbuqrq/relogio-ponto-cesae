<?php

namespace App\Services;

use App\AcaoPresenca;
use App\Repositories\CronogramaRepository;
use App\Repositories\PresencaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PresencaService
{
    protected $presencarepositorio;
    protected $cronogramarepositorio;

    //Construtor do Repositorio
    public function __construct(PresencaRepository $presencarepositorio, CronogramaRepository $cronogramarepositorio)
    {
        $this->presencarepositorio = $presencarepositorio;
        $this->cronogramarepositorio = $cronogramarepositorio;
    }


    //método que verifica se o aluno já inseriu Pin para acao=check-in
    public function pinJaInserido($cronograma_id)
    {
        return $this->presencarepositorio->buscarCheckIn($cronograma_id);
    }

    //método verifica se o aluno já fez check-out manual, acao=check-out
    public function existeCheckOut($cronograma_id)
    {

        return $this->presencarepositorio->buscarCheckOut($cronograma_id);
    }

    //método para buscar historico de presenças e verificar o status da aula:presente, pendente, ausente, usa o metodo auxiliar statusCondicao()
    public function historicoAluno(array $filtros)
    {
        $aluno_id = Auth::id();

        //busca no as ausência no cronograma de acordo com os filtros
        $cronogramas = $this->cronogramarepositorio->buscarCronogramaPorTurma($aluno_id, $filtros);

        // Buscar presenças do aluno
        $presencasAgrupadas = $this->presencarepositorio->buscarHistoricoAluno($aluno_id);

        // Construir histórico
        $historico = collect();

        foreach ($cronogramas as $cronograma) {
            $presencasDoCronograma = $presencasAgrupadas->get($cronograma->id, collect());

            // Verificar presença com check_in
            $checkIn = $presencasDoCronograma->firstWhere('acao', AcaoPresenca::CheckIn);

            $checkOut = $presencasDoCronograma->firstWhere('acao', AcaoPresenca::CheckOut);

            // definição do status
            if (!$checkIn) {
                $status = 'ausente';
            } elseif ($checkIn && !$checkOut) {
                $status = 'pendente';
            } else {
                $status = 'presente';
            }

            $item = (object)[
                'cronograma' => $cronograma,
                'check_in' => $checkIn?->created_at ?? null,
                'check_out' => $checkOut?->created_at ?? null,
                'status' => $status,
            ];

            if (!empty($filtros['status']) && $item->status !== $filtros['status']) {
                continue;
            }

            $historico->push($item);
        }

        return $historico;
    }

    //método para verificar se o aluno tem presença, se sim, não precisa de justificacao, usa o método auxiliar statusCondicao()
    public function temPresenca($cronograma_id)
    {

        return $this->presencarepositorio->buscarPresencaAluno($cronograma_id);
    }

    //método auxiliar do statusAula
    public function statusCondicao($historico)
    {
        $hasCheckIn = !is_null($historico->check_in);
        $hasCheckOut = !is_null($historico->check_out);

        if ($hasCheckIn && $hasCheckOut) {
            return 'presente';
        }

        if ($hasCheckIn || $hasCheckOut) {
            return 'pendente';
        }

        return 'ausente';
    }

    public function historicoFormador($formadorId, $filtros)
    {
        $historico = $this->presencarepositorio->buscarHistoricoFormador($formadorId, $filtros);

        return $historico
            ->map(function ($item) {
                $item->status = $this->statusCondicao($item);
                return $item;
            })
            ->filter(function ($item) use ($filtros) {
                if (!empty($filtros['status'])) {
                    return $item->status === $filtros['status'];
                }
                return true;
            });
    }

public function atualizarPresenca($dados)
{
    $presencaId = $dados['presenca_id'];
    $novoCheckIn = $dados['check_in'] ?? null;
    $novoCheckOut = $dados['check_out'] ?? null;
    $comentario = $dados['comentario'] ?? '';

    // Verifica se há check-in ou check-out a alterar
    if ($novoCheckIn) {
        $checkIn = Presenca::find($presencaId);

        if ($checkIn && $checkIn->acao === 'check_in') {
            $checkIn->registrado_em = $checkIn->created_at->format('Y-m-d') . ' ' . $novoCheckIn;
            $checkIn->comentario = $comentario;
            $checkIn->save();
        }
    }

    if ($novoCheckOut) {
        // Encontra o check-out correspondente ao mesmo cronograma e aluno
        $checkIn = Presenca::find($presencaId);

        $checkOut = Presenca::where('aluno_id', $checkIn->aluno_id)
            ->where('cronograma_id', $checkIn->cronograma_id)
            ->where('acao', 'check_out')
            ->first();

        if ($checkOut) {
            $checkOut->registrado_em = $checkOut->created_at->format('Y-m-d') . ' ' . $novoCheckOut;
            $checkOut->comentario = $comentario;
            $checkOut->save();
        }
    }
}
}
