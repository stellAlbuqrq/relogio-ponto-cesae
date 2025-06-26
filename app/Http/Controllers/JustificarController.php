<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Services\CronogramaService;
use App\Services\PinService;
use App\Services\PresencaService;
use Illuminate\Http\Request;

class JustificarController extends Controller
{
    protected $cronogramaService;
    protected $pinService;
    protected $presencaService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PinService $pinService, PresencaService $presencaService)
    {
        ################## TIRAR SERVICES NAO USADOS
        $this->cronogramaService = $cronogramaService;
        $this->pinService = $pinService;
        $this->presencaService = $presencaService;
    }

    public function justificarFaltas(){

        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        if (!$cronograma_id) {
            return view('aluno.presenca')->with('Este dia não teve aula.');
        }
        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        #################### ajustar -> falta atributo anexo para salvar os ficheiros inseridos e tambem o metodo que salva o check in manaul

        return view('aluno.justificacoes', ['cronograma' => $cronograma]);

    }
}
