<?php

namespace App\Repositories;

use App\Models\Pin;

class PinRepository
{
    //método procura se um pin já foi disparado dado o cronograma_id, isso garante que não terá mais de um PIN por aula
    public function existePin($cronograma_id){

        return Pin::where('cronograma_id', $cronograma_id)->exists();

    }

    //método procura o valor do PIN de 4 dígitos
    public function buscarPin($cronograma_id){
        return Pin::where('cronograma_id', $cronograma_id)->latest()->first();
    }






}
