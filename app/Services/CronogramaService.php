<?php

namespace App\Services;

use App\Models\Cronograma;
use App\Repositories\CronogramaRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CronogramaService
{
    protected $cronogramaRepositorio;

    //Construtor do Repositorio
    public function __construct(CronogramaRepository $cronogramaRepositorio)
    {
        $this->cronogramaRepositorio = $cronogramaRepositorio;
    }


    public function obterDiaCronograma()
    {
        //verificar o cronograma_id da aula
        $dataAgora = Carbon::now()->toDateString();
        $horaAgora = Carbon::now()->toTimeString();

        //Buscar se a data de "hoje" existe no campo data do cronograma
        $dataCronograma = Cronograma::where('data', $dataAgora)->first();

        //Validação para casos de feriados/fins de semana, estes dias não estão incluídos na tabela do cronograma
        if (!$dataCronograma) {
            return null;
        }

        return $this->cronogramaRepositorio->buscarIdDoDiaDoCronograma($dataAgora, $horaAgora);
    }

    //método para buscar o cronograma especifico do dia que o aluno quer justificar
    public function obterCronograma($dataJustificacao, $horaInicio){

        return $this->cronogramaRepositorio->buscarCronogramaJustificacao($dataJustificacao,$horaInicio);
    }

    //método para buscar os cronogramas por formador
    public function obterCronogramaFormador($formador_id){

        return $this->cronogramaRepositorio->buscarCronogramaPorFormador($formador_id);
    }
}
