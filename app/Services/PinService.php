<?php

namespace App\Services;

use App\Models\Pin;
use App\Repositories\PinRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PinService
{
    protected $pinrepositorio;

    //Construtor do Repositorio
    public function __construct(PinRepository $pinrepositorio)
    {
        $this->pinrepositorio = $pinrepositorio;
    }

    //método verifica que o pin é único na tabela de Pin
     public function gerarPinUnico()
    {
        do {
            $pin = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);          //PIN de 4 dígitos (1000 a 9999)
        } while (Pin::where('pin', $pin)->exists());

        return $pin;
    }

    //método verifica se já existe um pin para aquela aula
    public function buscarUmPinPorAula($cronograma_id)
    {
        return $this->pinrepositorio->existePin($cronograma_id);
    }

    //método busca o pin existente
    public function mostrarPin($cronograma_id){

        return $this->pinrepositorio->buscarPIN($cronograma_id);

    }


}
