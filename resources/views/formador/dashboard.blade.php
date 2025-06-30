<head>
    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

</head>

@extends('layouts.paginaFormador')


@section('content')
    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#40155E] text-4xl">Área do Formador</h1>
    </div>

    {{-- Título + frase quando não há aulas --}}
    <div class="flex items-center ml-4 mt-4 mb-6 gap-4">
        <h2 class="font-bold text-[#40155E] text-2xl">As suas aulas de hoje:</h2>

        @if ($aulas->isEmpty())
            <span class="font-bold text-[#40155E] text-2xl">Você não tem aulas hoje.</span>
        @endif
    </div>

    {{-- Aulas do dia --}}
    @if ($aulas->isNotEmpty())
        <div class="flex flex-wrap justify-center gap-5 mb-12">
            @foreach ($aulas as $aula)
                <div class="border p-5 rounded-2xl bg-[#7426AA] text-[#EAEAEA] shadow min-w-[300px] max-w-md">
                    <p class="font-semibold text-center">
                        <span><strong>Turma:</strong> {{ $aula->modulo->turma->nome }}</span>
                        <span class="mx-2">|</span>
                        <span><strong>Módulo:</strong> {{ $aula->modulo->nome }}</span>
                    </p>
                </div>
            @endforeach
        </div>
    @endif
    </div>

    @if (session('mensagem'))
        <div
            class="flex items-start space-x-3 bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 shadow-sm">
            <svg class="w-6 h-6 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L9 12.293l6.293-6.293a1 1 0 011.414 0z" />
            </svg>
            <div class="flex-1 text-sm font-medium">
                {{ session('mensagem') }}
            </div>
            <button type="button" onclick="this.parentElement.remove()"
                class="text-green-500 hover:text-green-700 focus:outline-none text-lg font-bold leading-none">
                &times;
            </button>
        </div>
    @endif

@endsection
