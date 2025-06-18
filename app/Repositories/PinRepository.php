<?php

namespace App\Repositories;

use App\Models\Pin;

class PinRepository
{
    //método procura se um pin já foi disparado dado o cronograma_id, isso garante que não terá mais de um PIN por aula
    public function existePin($cronograma_id){

        return Pin::where('cronograma_id', $cronograma_id)->exists();

    }

    public funCtion buscarPin($cronograma_id){
        $pin = Pin::where('cronograma_id', $cronograma_id)->firstOrFail();
        return $pin;
    }




}
