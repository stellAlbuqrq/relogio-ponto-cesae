<?php

namespace App\Repositories;

use App\AcaoPresenca;
use App\Models\Presenca;
use Illuminate\Support\Facades\Auth;

class PresencaRepository
{
    //método busca na tabela presenca se aluno já fez check-in com certo PIN
    public function buscarCheckIn($cronograma_id){

        $aluno_id = Auth::id();

        return Presenca::where('aluno_id', $aluno_id)
        ->where('cronograma_id', $cronograma_id)
        ->where('acao', AcaoPresenca::CheckIn)
        ->exists();
    }

    //método busca na tabela presenca se o aluno já fez check-out manual
    public function buscarCheckOut($cronograma_id){

        $aluno_id = Auth::id();

        return Presenca::where('aluno_id', $aluno_id)
        ->where('cronograma_id', $cronograma_id)
        ->where('acao', AcaoPresenca::CheckOut)
        ->exists();
    }


    //método para buscar historico de presenças
    public function buscarHistoricoAluno(){

        $aluno_id = Auth::id();

        return Presenca::with('cronograma')
        ->where('aluno_id', $aluno_id)
        ->orderBy('created_at', 'desc')
        ->get();

    }

}
