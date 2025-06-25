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

    // public function buscarCronogramasDoDia($hoje){

    //     return Cronograma::whereDate('data', $hoje)
    // }

}
