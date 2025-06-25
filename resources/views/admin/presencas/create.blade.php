@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full max-w-xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Registrar Presença</h1>

    <form action="{{ route('admin.presencas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="aluno_id" class="block font-medium">Aluno</label>
            <select name="aluno_id" class="w-full border p-2 rounded" required>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="cronograma_id" class="block font-medium">Cronograma</label>
            <select name="cronograma_id" class="w-full border p-2 rounded" required>
                @foreach($cronogramas as $cronograma)
                    <option value="{{ $cronograma->id }}">
                        {{ $cronograma->modulo->nome }} - {{ $cronograma->data }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="acao" class="block font-medium">Ação</label>
            <select name="acao" class="w-full border p-2 rounded" required>
                <option value="check-in">Check-in</option>
                <option value="check-out">Check-out</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="pin" class="block font-medium">PIN usado</label>
            <input type="text" name="pin" class="w-full border p-2 rounded" maxlength="4" required>
        </div>

        <div class="mb-4">
            <label for="comentario" class="block font-medium">Comentário</label>
            <textarea name="comentario" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="registrado_em" class="block font-medium">Data/Hora</label>
            <input type="datetime-local" name="registrado_em" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Registrar</button>
    </form>
</div>
@endsection
