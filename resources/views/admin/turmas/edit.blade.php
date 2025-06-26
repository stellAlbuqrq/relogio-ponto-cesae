@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full max-w-xl p-6 mx-auto">
    <h1 class="text-xl font-bold mb-4">Editar Turma</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.turmas.update', $turma) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Nome da Turma</label>
            <input type="text" name="nome" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('nome', $turma->nome) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Curso</label>
            <select name="curso_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $turma->curso_id == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Data de Início</label>
            <input type="date" name="data_inicio" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('data_inicio', $turma->data_inicio) }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Data de Fim</label>
            <input type="date" name="data_fim" class="w-full border border-gray-300 rounded px-3 py-2" value="{{ old('data_fim', $turma->data_fim) }}" required>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Atualizar Turma</button>
            <a href="{{ route('admin.turmas.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
