@extends('layouts.user-layout.admin-layout')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detalhes da Turma</h1>

    <div class="bg-white rounded shadow p-4">
        <p><strong>Nome:</strong> {{ $turma->nome }}</p>
        <p><strong>Curso:</strong> {{ $turma->curso->nome }}</p>
        <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}</p>
        <p><strong>Data de Fim:</strong> {{ \Carbon\Carbon::parse($turma->data_fim)->format('d/m/Y') }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.turmas.edit', $turma) }}" class="text-blue-600 hover:underline">Editar</a> |
        <a href="{{ route('admin.turmas.index') }}" class="text-gray-600 hover:underline">Voltar à lista</a>
    </div>
</div>
@endsection
