@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full px-10">
    <h1 class="text-2xl font-bold mb-6">Lista de Cursos</h1>

    <a href="{{ route('admin.cursos.create') }}" class="bg-green-500 text-gray px-4 py-2 rounded">Novo Curso</a>

    <table class="mt-6 w-full table-auto bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $curso->id }}</td>
                <td class="px-4 py-2">{{ $curso->nome }}</td>
                <td class="px-4 py-2">{{ $curso->descricao }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.cursos.edit', $curso) }}" class="text-blue-500">Editar</a>
                    <form action="{{ route('admin.cursos.destroy', $curso) }}" method="POST"
                          onsubmit="return confirm('Deseja excluir este curso?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
