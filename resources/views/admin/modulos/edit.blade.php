@extends('layouts.user-layout.admin-layout')


@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Editar Módulo</h1>

    <form action="{{ route('admin.modulos.update', $modulo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nome do Módulo</label>
            <input type="text" name="nome" value="{{ old('nome', $modulo->nome) }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Turma</label>
            <select name="turma_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione...</option>
                @foreach($turmas as $turma)
                    <option value="{{ $turma->id }}" {{ $turma->id == $modulo->turma_id ? 'selected' : '' }}>
                        {{ $turma->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Formador</label>
            <select name="formador_id" class="w-full border p-2 rounded" required>
                <option value="">Selecione...</option>
                @foreach($formadores as $formador)
                    <option value="{{ $formador->id }}" {{ $formador->id == $modulo->formador_id ? 'selected' : '' }}>
                        {{ $formador->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Carga Horária</label>
            <input type="number" name="carga_horaria" value="{{ old('carga_horaria', $modulo->carga_horaria) }}" required class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Atualizar</button>
    </form>
</div>
@endsection
