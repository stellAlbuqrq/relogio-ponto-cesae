<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CronogramaService
{
    protected $cronogramaRepositorio;

    //Construtor do Repository
    public function __construct(CronogramaService $cronogramaRepositorio)
    {
        $this->cronogramaRepositorio = $cronogramaRepositorio;
    }

    public function obterDiaCronograma($dataAgora, $horaAgora){

        //Validação para casos de feriados/fins de semana, estes dias não estão incluídos na tabela do cronograma
        if(!$dataAgora){
            return redirect()->back()->with('error', 'Hoje não tem aula.');
        }
        //return $this->cronogramaRepositorio->buscarIndoDiaDoCronograma(); //terminar de FAZER O METODO DE QUERY

    }


}
