@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full max-w-xl mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Criar Curso</h1>

    <form method="POST" action="{{ route('admin.cursos.store') }}">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block font-semibold">Nome do Curso</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                   class="w-full border px-3 py-2 rounded" required>
            @error('nome') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="descricao" class="block font-semibold">Descrição</label>
            <textarea name="descricao" id="descricao"
                      class="w-full border px-3 py-2 rounded">{{ old('descricao') }}</textarea>
        </div>

        <button type="submit" class="bg-green-500 text-gray px-4 py-2 rounded">Salvar</button>
        <a href="{{ route('admin.cursos.index') }}" class="ml-2 text-gray-700">Cancelar</a>
    </form>
</div>
@endsection
