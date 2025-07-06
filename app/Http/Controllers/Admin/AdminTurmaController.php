<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Http\Request;

class AdminTurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::with(['curso','cronogramas'])->get();
        return view('admin.turmas.index', compact('turmas'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('admin.turmas.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        Turma::create($validated);
        return redirect()->route('admin.turmas.index')->with('success', 'Turma criada com sucesso.');
    }

    public function show(Turma $turma)
    {
        return view('admin.turmas.show', compact('turma'));
    }

    public function edit(Turma $turma)
    {
        $cursos = Curso::all();
        return view('admin.turmas.edit', compact('turma', 'cursos'));
    }

    public function update(Request $request, Turma $turma)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
        ]);

        $turma->update($validated);
        return redirect()->route('admin.turmas.index')->with('success', 'Turma atualizada com sucesso.');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('admin.turmas.index')->with('success', 'Turma excluída.');
    }
}
