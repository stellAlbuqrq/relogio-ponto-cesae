@extends('layouts.user-layout.admin-layout')


@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">Detalhes do Módulo</h1>

    <div class="mb-2"><strong>Nome:</strong> {{ $modulo->nome }}</div>
    <div class="mb-2"><strong>Turma:</strong> {{ $modulo->turma->nome ?? '—' }}</div>
    <div class="mb-2"><strong>Formador:</strong> {{ $modulo->formador->nome ?? '—' }}</div>
    <div class="mb-2"><strong>Carga Horária:</strong> {{ $modulo->carga_horaria }}h</div>

    <a href="{{ route('admin.modulos.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Voltar</a>
</div>
@endsection
