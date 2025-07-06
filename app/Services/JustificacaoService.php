<?php

namespace App\Services;

use App\Repositories\JustificacaoRepository;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class JustificacaoService
{
    protected $justificacaorepositorio;

    //Construtor do Repositorio
    public function __construct(JustificacaoRepository $justificacaorepositorio)
    {
        $this->justificacaorepositorio = $justificacaorepositorio;
    }

    //método que filtra as justificacoes de acordo com o formador responsável
    public function justificacoesPorFormador($cronogramaIds){

    return $this->justificacaorepositorio->buscarjustificacoes($cronogramaIds);

    }

    //método que busca as justificacoes de X aluno
    public function justificacoesPorAluno($cronograma_id, $aluno_id){
        return $this->justificacaorepositorio->buscarJustificacoesAluno($cronograma_id, $aluno_id);
    }
}
