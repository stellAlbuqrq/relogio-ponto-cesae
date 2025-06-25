<?php

namespace App\Services;

use App\Repositories\PresencaRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PresencaService
{
    protected $presencarepositorio;

    //Construtor do Repositorio
    public function __construct(PresencaRepository $presencarepositorio)
    {
        $this->presencarepositorio = $presencarepositorio;
    }


    //método que verifica se o aluno já inseriu Pin para acao=check-in
    public function pinJaInserido($cronograma_id)
    {
        return $this->presencarepositorio->buscarCheckIn($cronograma_id);

    }

    //método verifica se o aluno já fez check-out manual, acao=check-out
    public function existeCheckOut($cronograma_id){

        return $this->presencarepositorio->buscarCheckOut($cronograma_id);

    }

    //método para buscar historico de presenças
    public function historicoAluno(){

        return $this->presencarepositorio->buscarHistoricoAluno();

    }
}
