<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;

class AdminModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::all();
        return view('admin.modulos.index', compact('modulos'));
    }

    public function create()
    {
        $turmas = Turma::all();
        $formadores = User::where('role', 'formador')->get();
        return view('admin.modulos.create', compact('turmas', 'formadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'turma_id' => 'required|exists:turmas,id',
            'formador_id' => 'required|exists:users,id',
            'carga_horaria' => 'required|numeric|min:1',
        ]);
        Modulo::create($request->all());
        return redirect()->route('admin.modulos.index')->with('success', 'Módulo criado.');
    }

    public function edit(Modulo $modulo)
    {
        $turmas = Turma::all();
        $formadores = User::where('role', 'formador')->get();

        return view('admin.modulos.edit', compact('modulo', 'turmas', 'formadores'));
    }


    public function show(Modulo $modulo)
    {
        return view('admin.modulos.show', compact('modulo'));
    }

    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'nome' => 'required|string',
            'turma_id' => 'required|exists:turmas,id',
            'formador_id' => 'required|exists:users,id',
            'carga_horaria' => 'required|numeric|min:1',
        ]);
        $modulo->update($request->all());
        return redirect()->route('admin.modulos.index')->with('success', 'Módulo atualizado.');
    }

    public function destroy(Modulo $modulo)
    {
        $modulo->delete();
        return redirect()->route('admin.modulos.index')->with('success', 'Módulo excluído.');
    }
}
