<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Módulo</title>

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
            <h1 class="text-3xl font-bold text-center text-[#4b4657] mb-6">Detalhes do Módulo</h1>

            <div class="text-gray-800 text-base space-y-3">
                <p><strong>Nome: </strong> {{ $modulo->nome }}</p>
                <p><strong>Turma: </strong> {{ $modulo->turma->nome ?? '—' }}</p>
                <p><strong>Formador: </strong>{{ $modulo->formador->nome ?? '—' }}</p>
                <p><strong>Carga Horária: </strong>{{ $modulo->carga_horaria }}h</p>
            </div>

            {{-- Botão Voltar --}}
            <div class="flex justify-center gap-4 mt-8">
                <a href="{{ route('admin.modulos.index') }}"
                    class="bg-[#4b4657] text-white font-semibold px-5 py-2 rounded-lg hover:bg-[#393543] transition duration-200 shadow-md">
                    Voltar
                </a>
            </div>
        </div>
    </div>

@endsection
