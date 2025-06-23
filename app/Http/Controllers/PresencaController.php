<?php

namespace App\Http\Controllers;

use App\AcaoPresenca;
use App\Models\Cronograma;
use App\Models\Presenca;
use App\Services\CronogramaService;
use App\Services\PinService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


//DisparoPinController será reponsável pelo evento realizado pelo Formador
//PresencaContoller será reponsável pelos eventos realizados pelo Aluno

class PresencaController extends Controller
{
    protected $cronogramaService;
    protected $pinService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PinService $pinService)
    {
        $this->cronogramaService = $cronogramaService;
        $this->pinService = $pinService;
    }


    //Método mostra a informação hora/data, aluno, módulo e botão "Picagem"
    public function presencaMostrar()
    {
        //Dados obtidos do cronograma -> com o cronograma_id obtemos o objeto cronograma onde tem toda a info de uma aula específica do cronograma (1 linha)
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        if (!$cronograma_id) {
            // Erro caso não tenha aula hoje
            return view('aluno.presenca')->with('error', 'Hoje não tem aula.');
        }
        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        return view('aluno.presenca', ['cronograma' => $cronograma]);
    }


    //Método que guarda o check-in
    public function presencaCheckInGuardar(Request $request)
    {
        //validação dos campos que vem do front-end: PIN e comentário inseridos
        $dadosValidados = $request->validate([
            'comentario' => 'nullable|string|max:1000',
            'pinInserido' => 'required|digits:4',
        ]);

        $pinInserido = $dadosValidados['pinInserido'];
        $comentario = $dadosValidados['comentario'];

        //obter cronograma_id
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //verificar se o formador já disparou o PIN
        $pinExistente = $this->pinService->buscarUmPinPorAula($cronograma_id);

        if (!$pinExistente) {
            return view('aluno.checkin', [
                'mensagem' => 'PIN ainda não foi ativo pelo formador.'
            ]);
        }

        $pinDisparado = $this->pinService->mostrarPin($cronograma_id);

        if ($pinInserido !== $pinDisparado) {
            return view('aluno.checkin', [
                'mensagem2' => 'PIN inserido incorreto. Tente novamente.'
            ]);
        }

        Presenca::create([
            'aluno_id' => auth()->id,
            'cronograma_id' => $cronograma_id,
            'acao' => AcaoPresenca::CheckIn,
            'pin' => $request->$pinInserido,
            'comentario' => $request->$comentario,
        ]);

        return view('aluno.presenca');
    }

    //Método que guarda o checkout
    public function presencaCheckOutGuardar(Request $request) {


    }

  public function paginaInicial()
    {

        return view('aluno.index');
    }


}
