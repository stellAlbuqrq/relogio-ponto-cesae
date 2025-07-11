<?php

namespace App\Http\Controllers;

use App\AcaoPresenca;
use App\Jobs\CheckOutAutomaticoJob;
use App\Jobs\JobTesteQueue;
use App\Models\Cronograma;
use App\Models\Modulo;
use App\Models\Presenca;
use App\Services\CronogramaService;
use App\Services\PinService;
use App\Services\PresencaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;


class PresencaController extends Controller
{
    protected $cronogramaService;
    protected $pinService;
    protected $presencaService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PinService $pinService, PresencaService $presencaService)
    {
        $this->cronogramaService = $cronogramaService;
        $this->pinService = $pinService;
        $this->presencaService = $presencaService;
    }


    //Método mostra a informação hora/data, aluno, módulo e botão "Picagem"
    public function presencaMostrar()
    {
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        if (!$cronograma_id) {
            return view('aluno.presenca', ['cronograma' => null, 'error' => 'Hoje não tem aula.']);
        }

        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        return view('aluno.presenca', ['cronograma' => $cronograma]);
    }


    //Método mostra página do check-out antecipado
    public function presencaMostrarOut()
    {
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        if (!$cronograma_id) {
            return view('aluno.presenca-out', ['cronograma' => null, 'error' => 'Hoje não tem aula.']);
        }

        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        return view('aluno.presenca-out', ['cronograma' => $cronograma]);
    }


    //Método que guarda o check-in
    public function presencaCheckInGuardar(Request $request)
    {
        //validação do campo que vem do front-end: PIN
        //validação importante!! -> pin na tabela 'presenca' deve ser unique em caso de check-in
        //na tabela o 'pin' é definido como not null mas na tabela 'presenca' deve ser nullable para aceitar as situações de check-out que não inserimos pin

        //obter cronograma_id
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //Validações:

        //1.Validação de presença já realizada, garante que só tem 1 checkIn por aula
        $mensagemErro = $this->presencaService->pinJaInserido($cronograma_id);
        if ($mensagemErro) {
            return redirect()->route('aluno.presenca')->with('mensagem', 'O aluno(a) já fez check-in');
        }

        //validar os dados caso o aluno não tenha checkin
        $dadosValidados = $request->validate([
            'pinInserido' => [
                'required',
                'digits:4',
                Rule::unique('presencas', 'pin'),
            ],
        ]);

        $pinInserido = $dadosValidados['pinInserido'];

        //2.Validação: se PIN foi disparado pelo formador (existe)
        $mensagemErro2 = $this->pinService->pinDisparado($cronograma_id);
        if ($mensagemErro2) {
            return redirect()->route('aluno.presenca')->with('mensagem', $mensagemErro2);
        }

        //3.Validação: se PIN já expirado
        $mensagemErro3 = $this->pinService->pinExpirado($cronograma_id);
        if ($mensagemErro3) {
            return redirect()->route('aluno.presenca')->with('checkin', $mensagemErro3);
        }

        //4.Validação: se PIN está correto
        $mensagemErro4 = $this->pinService->validarPin($cronograma_id, $pinInserido);
        if ($mensagemErro4) {
            return redirect()->route('aluno.presenca')->with('mensagem', $mensagemErro4);
        }

        $aluno_id = Auth::id();

        //Criar presenca
        Presenca::create([
            'aluno_id' => $aluno_id,
            'cronograma_id' => $cronograma_id,
            'acao' => AcaoPresenca::CheckIn,
            'pin' => $pinInserido,
        ]);

        ############### Check-out automatico a partir do Check-in
        //CheckOutAutomaticoJob fica agendado a partir do evento do check-in. Dispara o check-out 4 horas depois do check-in (manhã), e 3 horas depois (tarde)

        $cronograma = Cronograma::find($cronograma_id);
        //definir se é periodo manha ou tarde de acordo com o ponto de referência de 13hs
        $periodo = $cronograma->hora_inicio < '13:00:00' ? 'manha' : 'tarde';

        //horários de fim de aula
        $horaFimManha = Carbon::today()->setTime(13, 0, 0);  //manha
        $horaFimTarde = Carbon::today()->setTime(17, 0, 0);  //tarde

        //Se manha, horaFim é horaFimManha, se não..
        $horaFim = $periodo === 'manha' ? $horaFimManha : $horaFimTarde;

        $agora = Carbon::now();
        $delaySegundos = $agora->diffInSeconds($horaFim);


        if ($delaySegundos > 0) {
            //agendar o job para o final da aula
            Log::info('Agendando CheckOutAutomaticoJob com delay de ' . $delaySegundos . ' segundos para aluno ' . $aluno_id);
            CheckOutAutomaticoJob::dispatch($aluno_id, $cronograma->id, $periodo)
                //->delay(now()->addSeconds(100));   //teste
                ->delay(now()->addSeconds($delaySegundos));
        }

        return redirect()->route('aluno.presenca')->with('mensagem-sucesso', 'Presença registada com sucesso.');
    }



    //Método que guarda o checkout
    public function presencaCheckOutGuardar(Request $request)
    {
        //validação do campo que vem do front-end: comentário
        $dadosValidados = $request->validate([
            'comentario' => 'nullable|string|max:500',
        ]);

        //obter cronograma_id
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //validação se o aluno fez check-in
        if (!$this->presencaService->pinJaInserido($cronograma_id)) {
            return redirect()->route('aluno.presenca-out')->with('mensagem', 'Check-in ainda não realizado, não é possível realizar check-out.');
        }

        //validação se o aluno já fez check-out
        if ($this->presencaService->existeCheckOut($cronograma_id)) {
            return redirect()->route('aluno.presenca-out')->with('mensagem', 'Check-out já realizado.');
        }

        //Criar presenca check-out
        Presenca::create([
            'aluno_id' => Auth::id(),
            'cronograma_id' => $cronograma_id,
            'acao' => AcaoPresenca::CheckOut,
            'comentario' => $dadosValidados['comentario'] ?? null,
        ]);

        return redirect()->route('aluno.presenca-out')->with('mensagem-sucesso', 'Check-out registado com sucesso.');
    }

    public function presencaCheckInManual()
    {
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        if (!$cronograma_id) {
            return view('aluno.checkin-manual', ['cronograma' => null, 'error' => 'Hoje não tem aula.']);
        }

        $cronograma = Cronograma::with('modulo', 'formador')->findOrFail($cronograma_id);

        return view('aluno.checkin-manual', ['cronograma' => $cronograma]);
    }


    public function presencaCheckInManualGuardar(Request $request)
    {

        $dadosValidados = $request->validate([
            'comentario' => 'nullable|string|max:500',
        ]);

        $comentario = $dadosValidados['comentario'];

        //obter cronograma_id
        $cronograma_id = $this->cronogramaService->obterDiaCronograma();

        //Validação de presença já realizada, garante que só tem 1 checkIn por aula
        $mensagemErro = $this->presencaService->pinJaInserido($cronograma_id);

        if ($mensagemErro) {
            return redirect()->route('aluno.checkin-manual')->with('mensagem', 'O aluno(a) já fez check-in');
        }

        $aluno_id = Auth::id();

        //Criar presenca
        Presenca::create([
            'aluno_id' => $aluno_id,
            'cronograma_id' => $cronograma_id,
            'acao' => AcaoPresenca::CheckIn,
            'comentario' => $comentario,
        ]);

        ############### Check-out automatico a partir do Check-in
        //CheckOutAutomaticoJob fica agendado a partir do evento do check-in. Dispara o check-out 4 horas depois do check-in (manhã), e 3 horas depois (tarde)

        $cronograma = Cronograma::find($cronograma_id);
        //definir se é periodo manha ou tarde de acordo com o ponto de referência de 13hs
        $periodo = $cronograma->hora_inicio < '13:00:00' ? 'manha' : 'tarde';

        //horários de fim de aula
        $horaFimManha = Carbon::today()->setTime(13, 0, 0);  //manha
        $horaFimTarde = Carbon::today()->setTime(17, 0, 0);  //tarde

        //Se manha, horaFim é horaFimManha, se não..
        $horaFim = $periodo === 'manha' ? $horaFimManha : $horaFimTarde;

        $agora = Carbon::now();
        $delaySegundos = $agora->diffInSeconds($horaFim);


        if ($delaySegundos > 0) {
            //agendar o job para o final da aula
            Log::info('Agendando CheckOutAutomaticoJob com delay de ' . $delaySegundos . ' segundos para aluno ' . $aluno_id);
            CheckOutAutomaticoJob::dispatch($aluno_id, $cronograma->id, $periodo)
                //->delay(now()->addSeconds(100));   //teste
                ->delay(now()->addSeconds($delaySegundos));
        }

        return redirect()->route('aluno.checkin-manual')->with('mensagem-sucesso', 'Presença registada com sucesso.');
    }


    //Método que mostra todo o histórico de checkIn/checkOut
    public function presencaHistorico(Request $request)
    {
        $filtros = [
            'data_inicio' => $request->input('data_inicio'),
            'data_fim' => $request->input('data_fim'),
            'modulo_id' => $request->input('modulo_id'),
            'status' => $request->input('status'),
        ];

        $historico = $this->presencaService->historicoAluno($filtros);

        $modulos = Modulo::all();

        return view('aluno.historico', compact('historico', 'modulos'));
    }


}
