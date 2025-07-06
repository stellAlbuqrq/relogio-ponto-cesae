<?php

namespace App\Services;

use App\AcaoPresenca;
use App\Models\Cronograma;
use App\Models\Presenca;
use App\Repositories\CronogramaRepository;
use App\Repositories\PresencaRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class PresencaService
{
    protected $presencarepositorio;
    protected $cronogramarepositorio;

    //Construtor do Repositorio
    public function __construct(PresencaRepository $presencarepositorio, CronogramaRepository $cronogramarepositorio)
    {
        $this->presencarepositorio = $presencarepositorio;
        $this->cronogramarepositorio = $cronogramarepositorio;
    }


    //método que verifica se o aluno já inseriu Pin para acao=check-in
    public function pinJaInserido($cronograma_id)
    {
        return $this->presencarepositorio->buscarCheckIn($cronograma_id);
    }

    //método verifica se o aluno tem check-in-> mostrar ao formador
    public function existeCheckIn($cronograma_id)
    {

        return $this->presencarepositorio->buscarCheckInAluno($cronograma_id);
    }

    //método verifica se o aluno já fez check-out manual, acao=check-out
    public function existeCheckOut($cronograma_id)
    {
        return $this->presencarepositorio->buscarCheckOut($cronograma_id);
    }

    public function historicoAluno(array $filtros)
    {
        $aluno_id = Auth::id();

        //busca no as ausência no cronograma de acordo com os filtros
        $cronogramas = $this->cronogramarepositorio->buscarCronogramaPorTurma($filtros);

        // Buscar presenças do aluno
        $presencasAgrupadas = $this->presencarepositorio->buscarHistoricoAluno($aluno_id);


        $historico = collect();

        foreach ($cronogramas as $cronograma) {
            $presencasDoCronograma = $presencasAgrupadas->get($cronograma->id, collect());

            // Verificar presença com check_in
            $checkIn = $presencasDoCronograma->firstWhere('acao', AcaoPresenca::CheckIn);

            $checkOut = $presencasDoCronograma->firstWhere('acao', AcaoPresenca::CheckOut);

            $tempItem = (object)[
                'check_in' => $checkIn?->created_at ?? null,
                'check_out' => $checkOut?->created_at ?? null,
                'data_aula' => $cronograma->data,

            ];

            // método auxiliar de status
            $status = $this->statusCondicao($tempItem);

            $item = (object)[
                'cronograma' => $cronograma,
                'check_in' => $tempItem->check_in,
                'check_out' => $tempItem->check_out,
                'status' => $status,
            ];

            if (!empty($filtros['status']) && $item->status !== $filtros['status']) {
                continue;
            }

            $historico->push($item);
        }

        //paginacao
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $historico->slice(($currentPage - 1) * $perPage, $perPage)->all();


        $historicoPaginator = new LengthAwarePaginator(
            $currentPageItems,
            $historico->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return $historicoPaginator;
    }



    //método para verificar se o aluno tem presença, se sim, não precisa de justificacao, usa o método auxiliar statusCondicao()
    public function temPresenca($cronograma_id)
    {
        return $this->presencarepositorio->buscarPresencaAluno($cronograma_id);
    }

    //método auxiliar do statusAula
    public function statusCondicao($item): string
    {
        $hasCheckIn = !is_null($item->check_in);
        $hasCheckOut = !is_null($item->check_out);
        $dataAula = Carbon::parse($item->data_aula);

        if ($dataAula->isFuture()) {
            return 'pendente';
        }

        if ($hasCheckIn && $hasCheckOut) {
            return 'presente';
        }

        if ($hasCheckIn || $hasCheckOut) {
            // Se tem um ou outro e a data da aula já passou, ainda é 'pendente' (incompleto)
            return 'pendente';
        }

        // Se não tem nenhum registro e a aula já passou
        if (!$hasCheckIn && !$hasCheckOut && $dataAula->isPast()) {
            return 'ausente';
        }

        // Caso padrão para aulas futuras sem check-in/out ainda
        return 'pendente';
    }

    public function atribuirStatus(Collection $presencas): Collection
    {
        return $presencas->map(function ($presenca) {
            $presenca->status = $this->statusCondicao($presenca);
            return $presenca;
        });
    }

    /**
     * Gera o histórico de presenças para o formador, agregando check-in/out por cronograma e aluno.
     *
     * @param array $filtros Os filtros a serem aplicados (data_inicio, data_fim, modulo_id, aluno_nome, status).
     * @return Collection A coleção de objetos de histórico de presença, cada um representando uma presença agregada.
     */
    public function historicoFormador(array $filtros): Collection
    {
        $formadorId = Auth::id();
        $historico = collect();

        $cronogramasQuery = Cronograma::where('formador_id', $formadorId)
            ->with(['modulo']) // Carrega o módulo para exibir o nome
            ->orderBy('data', 'desc')
            ->orderBy('hora_inicio', 'desc');

        // Aplicar filtros de data diretamente nos cronogramas
        if (!empty($filtros['data_inicio'])) {
            $cronogramasQuery->where('data', '>=', $filtros['data_inicio']);
        }
        if (!empty($filtros['data_fim'])) {
            $cronogramasQuery->where('data', '<=', $filtros['data_fim']);
        }
        if (!empty($filtros['modulo_id'])) {
            $cronogramasQuery->where('modulo_id', $filtros['modulo_id']);
        }

        $cronogramas = $cronogramasQuery->get();


        foreach ($cronogramas as $cronograma) {

            $acoesPresencaCronograma = Presenca::where('cronograma_id', $cronograma->id)
                ->with('aluno')
                ->get();

            $presencasAgrupadasPorAluno = $acoesPresencaCronograma->groupBy('aluno_id');


            foreach ($presencasAgrupadasPorAluno as $alunoId => $acoesDoAluno) {
                $aluno = $acoesDoAluno->first()->aluno;

                $checkInObj = $acoesDoAluno->firstWhere('acao', AcaoPresenca::CheckIn);
                $checkOutObj = $acoesDoAluno->firstWhere('acao', AcaoPresenca::CheckOut);

                $presencaRegistroId = $checkInObj ? $checkInObj->id : null;

                $checkInTime = $checkInObj ? Carbon::parse($checkInObj->created_at)->format('H:i') : null;
                $checkOutTime = $checkOutObj ? Carbon::parse($checkOutObj->created_at)->format('H:i') : null;

                $tempItem = (object)[
                    'check_in' => $checkInObj?->created_at ?? null,
                    'check_out' => $checkOutObj?->created_at ?? null,
                    'data_aula' => $cronograma->data,
                ];

                $status = $this->statusCondicao($tempItem);

                // Aplicar filtro de nome do aluno e status
                if (!empty($filtros['aluno_nome']) && !Str::contains(Str::lower($aluno->nome), Str::lower($filtros['aluno_nome']))) {
                    continue;
                }

                if (!empty($filtros['status']) && $status !== $filtros['status']) {
                    continue;
                }

                $historico->push((object)[
                    'id' => $presencaRegistroId,
                    'cronograma' => $cronograma,
                    'aluno' => $aluno,
                    'check_in' => $checkInTime,
                    'check_out' => $checkOutTime,
                    'status' => $status,
                ]);
            }
        }

        return $historico;
    }

    public function atualizarPresenca($dados)
    {
        $presencaId = $dados['presenca_id'];
        $novoCheckIn = $dados['check_in'] ?? null;
        $novoCheckOut = $dados['check_out'] ?? null;
        $comentario = trim($dados['comentario'] ?? '');

        if (empty($comentario)) {
            throw new \Exception("Justificativa (comentário) é obrigatória para editar presença.");
        }

        $checkIn = Presenca::find($presencaId);
        if (!$checkIn) {
            throw new \Exception("Presença não encontrada.");
        }

        $cronograma = Cronograma::find($checkIn->cronograma_id);
        if (!$cronograma) {
            throw new \Exception("Cronograma não encontrado.");
        }

        // Determina o período
        $periodo = $cronograma->hora_inicio < '13:00:00' ? 'manha' : 'tarde';

        // Define os intervalos válidos
        $intervalos = [
            'manha' => ['inicio' => '09:00', 'fim' => '13:00'],
            'tarde' => ['inicio' => '14:00', 'fim' => '17:00'],
        ];

        $dataOriginal = $checkIn->created_at->format('Y-m-d');

        // Valida e atualiza Check-In
        if ($novoCheckIn) {
            if (!$this->horaDentroDoIntervalo($novoCheckIn, $intervalos[$periodo])) {
                throw new \Exception("Horário de check-in fora do intervalo permitido para o período da $periodo.");
            }

            $checkIn->created_at = Carbon::parse("$dataOriginal $novoCheckIn");
            $checkIn->comentario = $comentario;
            $checkIn->save();
        }

        // Valida e atualiza Check-Out
        if ($novoCheckOut) {
            if (!$this->horaDentroDoIntervalo($novoCheckOut, $intervalos[$periodo])) {
                throw new \Exception("Horário de check-out fora do intervalo permitido para o período da $periodo.");
            }

            // Check: hora do check-out não pode ser menor que o check-in
            $horaCheckinMinutos = Carbon::parse($dataOriginal . ' ' . $novoCheckIn)->format('H') * 60 + Carbon::parse($novoCheckIn)->format('i');
            $horaCheckoutMinutos = Carbon::parse($dataOriginal . ' ' . $novoCheckOut)->format('H') * 60 + Carbon::parse($novoCheckOut)->format('i');

            if ($horaCheckoutMinutos <= $horaCheckinMinutos) {
                throw new \Exception("O horário de check-out deve ser posterior ao check-in.");
            }

            // Encontra ou cria nova linha de check-out
            $checkOut = Presenca::where('aluno_id', $checkIn->aluno_id)
                ->where('cronograma_id', $checkIn->cronograma_id)
                ->where('acao', 'check_out')
                ->first();

            if ($checkOut) {
                $checkOut->created_at = Carbon::parse("$dataOriginal $novoCheckOut");
                $checkOut->comentario = $comentario;
                $checkOut->save();
            } else {
                // Cria novo registro de check-out se não existir
                Presenca::create([
                    'aluno_id' => $checkIn->aluno_id,
                    'cronograma_id' => $checkIn->cronograma_id,
                    'acao' => 'check_out',
                    'created_at' => Carbon::parse("$dataOriginal $novoCheckOut"),
                    'comentario' => $comentario,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Função auxiliar
    private function horaDentroDoIntervalo($hora, $intervalo)
    {
        return $hora >= $intervalo['inicio'] && $hora <= $intervalo['fim'];
    }
}
