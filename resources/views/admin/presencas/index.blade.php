@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="w-full p-6">
    <h1 class="text-2xl font-bold mb-4">Lista de Presenças</h1>

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left text-sm uppercase text-gray-600">
                <th class="px-4 py-2">Aluno</th>
                <th class="px-4 py-2">Cronograma</th>
                <th class="px-4 py-2">Ação</th>
                <th class="px-4 py-2">PIN</th>
                <th class="px-4 py-2">Comentário</th>
                <th class="px-4 py-2">Registrado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presencas as $presenca)
                <tr class="border-b text-gray-700">
                    <td class="px-4 py-2">{{ $presenca->aluno->nome ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $presenca->cronograma->modulo->nome ?? '—' }}</td>
                    <td class="px-4 py-2">{{ ucfirst($presenca->acao) }}</td>
                    <td class="px-4 py-2">{{ $presenca->pin }}</td>
                    <td class="px-4 py-2">{{ $presenca->comentario }}</td>
                    <td class="px-4 py-2">{{ $presenca->registrado_em }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
