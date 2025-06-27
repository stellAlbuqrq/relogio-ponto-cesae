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
    public function existeCheckOut($cronograma_id)
    {

        return $this->presencarepositorio->buscarCheckOut($cronograma_id);
    }

    //método para buscar historico de presenças e verificar o status da aula:presente, pendente, ausente, usa o metodo auxiliar statusCondicao()
    public function historicoAluno()
    {
        $historico = $this->presencarepositorio->buscarHistoricoAluno();

        return $historico->map(function ($item) {
            $item->status = $this->statusCondicao($item);
            return $item;
        });
    }

    //método para verificar se o aluno tem presença, se sim, não precisa de justificacao, usa o método auxiliar statusCondicao()
    public function temPresenca($cronograma_id){

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
}

