<?php

namespace App\Http\Controllers;

use App\Services\CronogramaService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    protected $cronogramaService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService)
    {
        $this->cronogramaService = $cronogramaService;
    }

    //Método mostra a informação hora/data, aluno, módulo e botão "Picagem"
    public function presencaMostrar()
    {
        $dataAgora = Carbon::now()->toDateString();
        $horaAgora = Carbon::now()->toTimeString();

        $query = $this->cronogramaService->obterDiaCronograma($dataAgora, $horaAgora);
        $registroPresenca = $query;



        //Variavel $dataHoraAtual -> mostrar no front-end e também guardar
        // $dataHoraAtual = Carbon::now();
        // return view('alunos.teste', $dataHoraAtual);

        //na view eu posso mostrar a HORA E DATA com Javascript, será apenas algo visual
        //vou precisar fazer diferente, o form do view tem que ser um POST para guardar as informações
        //POR GARANTIA, ao criar uma instancia ponto eu vou fazer o registrado_em = now(), assim assegura que o valor é confiável
        //eX:
    }

    public function presencaGuardar()
    {
        //EXEMPLO DO STORE
        /*
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->nome = $request->nome;
        // Guarda a data/hora atual gerada pelo servidor
        $reserva->registrado_em = now();
        $reserva->save();

        return redirect()->back()->with('success', 'Reserva criada com sucesso!');
    }*/
    }
}
