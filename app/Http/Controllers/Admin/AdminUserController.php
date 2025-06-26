<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required|in:admin,formador,aluno',
    ]);

    $validated['password'] = bcrypt($validated['password']);

    User::create($validated);
    return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso.');
}

    public function show(User $usuario)
    {
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
{
    $validated = $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $usuario->id,
        'role' => 'required|in:admin,formador,aluno',
    ]);

    $usuario->update($validated);
    return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado.');
}
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário excluído.');
    }
}
