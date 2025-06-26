@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Editar Presença</h1>

    <form action="{{ route('admin.presencas.update', $presenca->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="comentario" class="block font-medium">Comentário</label>
            <textarea name="comentario" class="w-full border p-2 rounded">{{ $presenca->comentario }}</textarea>
        </div>

        <div class="mb-4">
            <label for="registrado_em" class="block font-medium">Data/Hora</label>
            <input type="datetime-local" name="registrado_em" class="w-full border p-2 rounded"
                value="{{ \Carbon\Carbon::parse($presenca->registrado_em)->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
    </form>
</div>
@endsection
