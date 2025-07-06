<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Turma</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    {{-- Daisy UI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
</head>

@extends('layouts.paginaAdministrador')

@section('content')
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white rounded-2xl shadow-xl px-10 py-8 w-full max-w-lg border">
            <h1 class="text-3xl font-bold text-center text-[#AD87C6] mb-6">Detalhes da Turma</h1>

            <div class="text-gray-800 text-base space-y-3">
                <p><strong>Nome:</strong> {{ $turma->nome }}</p>
                <p><strong>Curso:</strong> {{ $turma->curso->nome }}</p>
                <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($turma->data_inicio)->format('d/m/Y') }}</p>
                <p><strong>Data de Fim:</strong> {{ \Carbon\Carbon::parse($turma->data_fim)->format('d/m/Y') }}</p>
            </div>

            {{-- Botões --}}
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('admin.turmas.edit', $turma) }}"
                    class="bg-[#AD87C6] text-white font-semibold px-5 py-2 rounded-lg hover:bg-[#9f76b9] transition duration-200 shadow-md">
                    Editar
                </a>

                <a href="{{ route('admin.turmas.index') }}"
                    class="bg-[#6A239B] text-white font-semibold px-5 py-2 rounded-lg hover:bg-[#5c2a7e] transition duration-200 shadow-md">
                    Voltar à lista
                </a>
            </div>
        </div>
    </div>
@endsection
