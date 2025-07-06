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

        // Buscar diretamente um PIN válido (não expirado) para esta aula
        $pinExistente = Pin::where('cronograma_id', $cronograma_id)
            ->where('expires_at', '>', Carbon::now())
            ->latest()
            ->first();

        if ($pinExistente) {
            $horaExpiracao = Carbon::parse($pinExistente->expires_at)->format('H:i:s');

            return view('formador.duracao-pin', [
                'pin' => $pinExistente->pin,
                'horaExpiracao' => $horaExpiracao,
                'mensagem' => 'Já existe um PIN ativo para esta aula.'
            ]);
        }

        // Se não existe PIN válido, gera um novo
        $pin = $this->pinService->gerarPinUnico();

        $agora = Carbon::now();
        $horaExpiracao = $agora->copy()->addMinutes(10);       // tempo de expiração do PIN (10 minutos)
        $horaExpiracaoFormatada = $horaExpiracao->format('H:i:s');    //Passa para o front-end apenas as horas sem data

        //Adicionar o Pin na tabela PIN:
        Pin::create([
            'cronograma_id' => $cronograma_id,
            'pin' => $pin,
            'expires_at' => $horaExpiracao,
        ]);

        return view('formador.duracao-pin', [
            'pin' => $pin,
            'horaExpiracao' => $horaExpiracaoFormatada
        ]);
    }
}
