@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full p-6">
    <h1 class="text-xl font-bold mb-4">Lista de Turmas</h1>

    <a href="{{ route('admin.turmas.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Nova Turma</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Curso</th>
                <th class="px-4 py-2">Início</th>
                <th class="px-4 py-2">Fim</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
                <tr class="text-center border-t">
                    <td class="px-4 py-2">{{ $turma->nome }}</td>
                    <td class="px-4 py-2">{{ $turma->curso->nome }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($turma->data_fim)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.turmas.show', $turma) }}" class="text-blue-500">Ver</a>
                        <a href="{{ route('admin.turmas.edit', $turma) }}" class="text-yellow-500">Editar</a>
                        <form action="{{ route('admin.turmas.destroy', $turma) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-500">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
