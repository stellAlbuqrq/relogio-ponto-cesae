<?php

namespace App\Repositories;

use App\Models\Justificativa;

class JustificacaoRepository
{

    //método que busca as justificacoes dos alunos
    public function buscarjustificacoes($cronogramaIds)
    {

        return Justificativa::with(['aluno', 'cronograma'])
            ->whereIn('cronograma_id', $cronogramaIds)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    //método que busca as justificacoes de certo aluno
    public function buscarJustificacoesAluno($cronograma_id, $aluno_id)
    {
        return Justificativa::with('cronograma')
            ->where('aluno_id', $aluno_id)
            ->where('cronograma_id', $cronograma_id)
            ->first();
    }
}
