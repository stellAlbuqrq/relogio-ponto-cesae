<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Models\Pin;
use App\Services\CronogramaService;
use App\Services\PinService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisparoPinController extends Controller
{

    //declarar o service
    protected $pinService;
    protected $cronogramaService;

    //Construtor do Service
    public function __construct(PinService $pinService, CronogramaService $cronogramaService)
    {
        $this->pinService = $pinService;
        $this->cronogramaService = $cronogramaService;
    }


    public function mostrarPin()
    {
        //Obter o cronograma_id da aula
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //Buscar a instancia associada ao cronograma_id
        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        return view('formador.pin', compact('cronograma'));
    }


    //Método para disparar PIN
    public function dispararPin(Request $request)
    {
        //Obter o cronograma_id da aula
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //Se $query é true, já existe um PIN para esta aula
        $query = $this->pinService->buscarUmPinPorAula($cronograma_id);

        //Se pin existe, ele busca o pin e passa para a view formador.duracao-pin
        if ($query == true) {

            $pinExistente = Pin::where('cronograma_id', $cronograma_id)->latest()->first();


            $horaExpiracao = Carbon::parse($pinExistente->created_at)->addMinutes(10)->format('H:i:s');

            return view('formador.duracao-pin', [
                'pin' => $pinExistente->pin,
                'horaExpiracao' => $horaExpiracao,
                'mensagem' => 'Já existe um PIN ativo para esta aula.'
            ]);
        }

        //gerar o pin
        $pin = $this->pinService->gerarPinUnico();

        $horaExpiracao = Carbon::now()->addMinutes(10)->format('H:i:s');       // Definir tempo de expiração do PIN (10 minutos)

        //dados guardados na session 'dadosPin'
        // session([
        //     'dadosPin' => [
        //         'pin' => $pin,
        //         'horaExpiracao' => $horaExpiracao,
        //     ]
        // ]);

        //no FRONT-END mostrar ao formador a hora que o PIN expira

        //Adicionar o Pin na tabela PIN:
        Pin::create([
            'cronograma_id' => $cronograma_id,
            'pin' => $pin,
        ]);

        return view('formador.duracao-pin', [
            'pin' => $pin,
            'horaExpiracao' => $horaExpiracao
        ]);
    }
}
