<?php

namespace App\Repositories;

use App\AcaoPresenca;
use App\Models\Presenca;
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


    //método para buscar historico de presenças
    public function buscarHistoricoAluno()
    {
        $presencas = Presenca::with('cronograma')
            ->where('aluno_id', Auth::id())
            ->get()
            ->groupBy('cronograma_id');

        //transformar 2 presencas (checkIn e checkOut em uma linha)
        return $presencas->map(function ($presencasDoDia) {
            $checkIn = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckIn);
            $checkOut = $presencasDoDia->firstWhere('acao', AcaoPresenca::CheckOut);

            return (object) [
                'cronograma' => $checkIn?->cronograma ?? $checkOut?->cronograma,
                'check_in' => $checkIn?->created_at,
                'check_out' => $checkOut?->created_at,
            ];
        });
    }
}
