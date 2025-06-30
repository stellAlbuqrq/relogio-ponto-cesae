<?php

namespace App\Repositories;

use App\AcaoPresenca;
use App\Models\Presenca;
use App\Services\PresencaService;
use Illuminate\Support\Facades\Auth;

class PresencaRepository
{
    //método busca na tabela presenca se aluno já fez check-in com certo PIN
    public function buscarCheckIn($cronograma_id)
    {

        $aluno_id = Auth::id();

        return Presenca::where('aluno_id', $aluno_id)
            ->where('cronograma_id', $cronograma_id)
            ->where('acao', AcaoPresenca::CheckIn)
            ->exists();
    }

    //método busca na tabela presenca se o aluno já fez check-out manual
    public function buscarCheckOut($cronograma_id)
    {

        $aluno_id = Auth::id();

        return Presenca::where('aluno_id', $aluno_id)
            ->where('cronograma_id', $cronograma_id)
            ->where('acao', AcaoPresenca::CheckOut)
            ->exists();
    }

    //método buscar se o aluno tem presença naquele cronograma_id -> tem checkin e tem checkout
    public function buscarPresencaAluno($cronograma_id)
    {

        return $this->buscarCheckIn($cronograma_id) && $this->buscarCheckOut($cronograma_id);
    }

    //método para buscar historico de presenças
    public function buscarHistoricoAluno($aluno_id)
    {
       return Presenca::where('aluno_id', $aluno_id)
        ->get()
        ->groupBy('cronograma_id');
    }

    // Histórico de presenças dos alunos em aulas que o formador ministra
    public function buscarHistoricoFormador($formadorId, $filtros)
    {
        $query = Presenca::with(['cronograma.modulo', 'aluno'])
            ->whereHas('cronograma', function ($q) use ($formadorId, $filtros) {
                $q->where('formador_id', $formadorId);

                if (!empty($filtros['modulo_id'])) {
                    $q->where('modulo_id', $filtros['modulo_id']);
                }

                if (!empty($filtros['data_inicio'])) {
                    $q->whereDate('data', '>=', $filtros['data_inicio']);
                }

                if (!empty($filtros['data_fim'])) {
                    $q->whereDate('data', '<=', $filtros['data_fim']);
                }
            });

        if (!empty($filtros['aluno_nome'])) {
            $query->whereHas('aluno', function ($q) use ($filtros) {
                $q->where('nome', 'like', '%' . $filtros['aluno_nome'] . '%');
            });
        }

        $presencas = $query->get()->groupBy('cronograma_id');

        return $presencas->map(function ($presencasDoDia) {
            $checkIn = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckIn);
            $checkOut = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckOut);

            return (object)[
                'cronograma' => $checkIn?->cronograma ?? $checkOut?->cronograma,
                'aluno' => $checkIn?->aluno ?? $checkOut?->aluno,
                'check_in' => $checkIn?->registrado_em,
                'check_out' => $checkOut?->registrado_em,
            ];
        });
        return $presencas->map(function ($presencasDoDia) {
            $checkIn = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckIn);
            $checkOut = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckOut);

            return (object)[
                'cronograma' => $checkIn?->cronograma ?? $checkOut?->cronograma,
                'aluno' => $checkIn?->aluno ?? $checkOut?->aluno,
                'check_in' => $checkIn?->registrado_em,
                'check_out' => $checkOut?->registrado_em,
            ];
        });
    }
}
