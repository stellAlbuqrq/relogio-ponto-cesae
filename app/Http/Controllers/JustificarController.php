<?php

namespace App\Http\Controllers;

use App\AcaoPresenca;
use App\Models\Cronograma;
use App\Models\Justificativa;
use App\Models\Presenca;
use App\Services\CronogramaService;
use App\Services\JustificacaoController;
use App\Services\JustificacaoService;
use App\Services\PinService;
use App\Services\PresencaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JustificarController extends Controller
{
    protected $cronogramaService;
    protected $presencaService;
    protected $justificacaoService;

    //Construtor do Service
    public function __construct(CronogramaService $cronogramaService, PresencaService $presencaService, JustificacaoService $justificacaoService)
    {
        ################## TIRAR SERVICES NAO USADOS
        $this->cronogramaService = $cronogramaService;
        $this->presencaService = $presencaService;
        $this->justificacaoService = $justificacaoService;
    }

    public function justificarFaltas()
    {

        return view('aluno.justificacoes');
    }

    public function justificarGuardar(Request $request)
    {
        //validar os dados recebidos do formulário
        $dadosValidados = $request->validate([
            'data_justificada' => 'required|date',
            'periodo' => 'required|in:manha,tarde',
            'comentario' => 'nullable|string|max:1000',
            'anexo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $dataJustificacao = $dadosValidados['data_justificada'];

        //verificar o periodo selecionado
        $horaInicio = $dadosValidados['periodo'] === 'manha' ? '09:00:00' : '14:00:00';

        //buscar o cronograma_id de acordo com a data e o periodo inseridos pelo aluno
        $cronograma_id = $this->cronogramaService->obterCronograma($dataJustificacao, $horaInicio);

        if (!$cronograma_id) {
            return redirect()->route('aluno.justificacoes')->with('mensagem', 'Não foi encontrado um cronograma para essa data e período.');
        }

        //buscar se o aluno não tem presença para aquele cronograma_id, se ele tem, não precisa justificar
        $presenca = $this->presencaService->temPresenca($cronograma_id);

        if ($presenca) {
            return redirect()->route('aluno.justificacoes')->with('mensagem', 'O aluno tem presença neste dia.');
        }

        //guardar caminho do anexo se for inserido
        $caminho = null;
        if ($request->hasFile('anexo')) {
            $caminho = $request->file('anexo')->store('justificacoes', 'public');
        }

        //criar a justificativa
        Justificativa::create([
            'aluno_id' => Auth::id(),
            'cronograma_id' => $cronograma_id,
            'data_justificada' => $dataJustificacao,
            'periodo' => $dadosValidados['periodo'],
            'data_justificada' => $dataJustificacao,
            'texto' => $dadosValidados['comentario'],
            'anexo' => $caminho ?? null,
        ]);

        return redirect()->route('aluno.dashboard')->with('mensagem', 'Justificação enviada com sucesso.');
    }

    //método que mostra as justificacoes dos alunos para o formador
    public function mostrarJustificacoes()
    {

        $formador_id = Auth::id();

        //busca todos os cronogramas do formador
        $cronogramas = $this->cronogramaService->obterCronogramaFormador($formador_id);

        //todos os cronogramas_id em um array
        $cronogramaIds = $cronogramas->pluck('id');

        $justificacoes = $this->justificacaoService->justificacoesPorFormador($cronogramaIds);

        return view('formador.justificacoes', compact('justificacoes'));
    }

    //método que aceita as justificacoes -> cria uma falta justificada
    public function aceitarJustificacoes(Justificativa $justificacao)
    {
        // verificar se a justificação já foi validada
        if ($justificacao->status !== 'pendente') {
            return redirect()->route('formador.justificacoes')->with('mensagem', 'Esta justificação já foi avaliada.');
        }
        // Atualizar status da justificação
        $justificacao->update([
            'status' => 'aprovada',    // quer dizer que se trata de uma falta justificada
            'avaliado_por' => Auth::id(),
            'avaliado_em' => now(),
        ]);

        return redirect()->route('formador.justificacoes')->with('mensagem-sucesso', 'Justificação Processada.');
    }

    //método que rejeita as justificacoes -> rejeita falta justificada
    public function rejeitarJustificacoes(Justificativa $justificacao)
    {
        // verificar se a justificação já foi validada
        if ($justificacao->status !== 'pendente') {
            return redirect()->route('formador.justificacoes')->with('mensagem', 'Esta justificação já foi avaliada.');
        }
        // Atualizar status da justificação
        $justificacao->update([
            'status' => 'recusada',
            'avaliado_por' => Auth::id(),
            'avaliado_em' => now(),
        ]);

        return redirect()->route('formador.justificacoes')->with('mensagem-sucesso', 'Justificação Processada.');
    }
}
