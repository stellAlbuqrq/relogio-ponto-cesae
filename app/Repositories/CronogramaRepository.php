<?php

namespace App\Repositories;

use App\Models\Cronograma;

class CronogramaRepository
{
    //Método busca o id do cronograma ou seja, da aula específica do dia e hora de "HOJE"
    public function buscarIdDoDiaDoCronograma($dataAgora, $horaAgora){

        return Cronograma::whereDate('data', $dataAgora)
        ->whereTime('hora_inicio', '<=', $horaAgora)
        ->whereTime('hora_fim', '>=', $horaAgora)
        ->first()?->id;
    }

    //método vai buscar o cronograma_id especifico de acordo com data e periodo
    public function buscarCronogramaJustificacao($dataJustificacao,$horaInicio){

        return Cronograma::whereDate('data', $dataJustificacao)
        ->whereTime('hora_fim', '>=', $horaInicio)
        ->first()?->id;
    }

    //método que busca o cronograma_id apenas de um formador específico, ou seja, pode incluir mais de um módulo
    public function buscarCronogramaPorFormador($formador_id){

        return Cronograma::where('formador_id', $formador_id)
        ->get();
    }



}
