<?php

namespace App\Repositories;

use App\Models\Justificativa;

class JustificacaoRepository
{

    //método que busca as justificacoes dos alunos
    public function buscarjustificacoes($cronogramaIds){

        return Justificativa::with(['aluno', 'cronograma'])
        ->whereIn('cronograma_id', $cronogramaIds)
        ->orderBy('created_at', 'desc')
        ->get();

    }



}
