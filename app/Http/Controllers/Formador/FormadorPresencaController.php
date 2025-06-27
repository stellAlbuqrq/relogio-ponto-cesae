<?php

namespace App\Http\Controllers\Formador;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use App\Services\CronogramaService;
use App\Services\PinService;
use Illuminate\Http\Request;
use App\Services\PresencaService;
use Illuminate\Support\Facades\Auth;

class FormadorPresencaController extends Controller
{
  protected $presencaService;

public function __construct(PresencaService $presencaService)
{
    $this->presencaService = $presencaService;
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Método que mostra todo o histórico de checkIn/checkOut
    public function presencaHistorico(Request $request)
{
    $formadorId = Auth::id();

    $filtros = [
        'data_inicio' => $request->input('data_inicio'),
        'data_fim' => $request->input('data_fim'),
        'modulo_id' => $request->input('modulo_id'),
        'aluno_nome' => $request->input('aluno_nome'),
        'status' => $request->input('status'),
    ];

    $historico = $this->presencaService->historicoFormador($formadorId, $filtros);

    // Listar apenas módulos que pertencem ao formador autenticado
    $modulos = Modulo::where('formador_id', $formadorId)->get();

    return view('formador.presencas.presencas', compact('historico', 'modulos'));
}
}
