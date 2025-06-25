@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Detalhes da Presença</h1>

    <ul class="space-y-3">
        <li><strong>Aluno:</strong> {{ $presenca->aluno->nome ?? '—' }}</li>
        <li><strong>Módulo:</strong> {{ $presenca->cronograma->modulo->nome ?? '—' }}</li>
        <li><strong>Data da aula:</strong> {{ $presenca->cronograma->data ?? '—' }}</li>
        <li><strong>Ação:</strong> {{ ucfirst($presenca->acao) }}</li>
        <li><strong>PIN:</strong> {{ $presenca->pin }}</li>
        <li><strong>Comentário:</strong> {{ $presenca->comentario ?? '—' }}</li>
        <li><strong>Registrado em:</strong> {{ $presenca->registrado_em }}</li>
    </ul>

    <a href="{{ route('admin.presencas.index') }}" class="mt-6 inline-block text-blue-600 hover:underline">← Voltar</a>
</div>
@endsection
