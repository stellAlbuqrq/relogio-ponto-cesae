@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-4">Lista de Módulos</h1>

    <a href="{{ route('admin.modulos.create') }}" class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        + Criar Módulo
    </a>

    @if(session('success'))
        <div class="mb-4 bg-green-200 text-green-800 p-3 rounded">{{ session('success') }}</div>
    @endif

    @if($modulos->isEmpty())
        <p>Nenhum módulo cadastrado.</p>
    @else
    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-3 py-2 border">ID</th>
                <th class="px-3 py-2 border">Nome</th>
                <th class="px-3 py-2 border">Turma</th>
                <th class="px-3 py-2 border">Formador</th>
                <th class="px-3 py-2 border">Carga Horária</th>
                <th class="px-3 py-2 border">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modulos as $modulo)
                <tr>
                    <td class="border px-3 py-2">{{ $modulo->id }}</td>
                    <td class="border px-3 py-2">{{ $modulo->nome }}</td>
                    <td class="border px-3 py-2">{{ $modulo->turma->nome ?? '—' }}</td>
                    <td class="border px-3 py-2">{{ $modulo->formador->nome ?? '—' }}</td>
                    <td class="border px-3 py-2">{{ $modulo->carga_horaria }}h</td>
                    <td class="border px-3 py-2 space-x-2">
                        <a href="{{ route('admin.modulos.show', $modulo) }}" class="text-blue-600 hover:underline">Ver</a>
                        <a href="{{ route('admin.modulos.edit', $modulo) }}" class="text-yellow-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.modulos.destroy', $modulo) }}" method="POST" class="inline-block" onsubmit="return confirm('Excluir este módulo?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection
