<head>
    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

</head>

@extends('layouts.paginaAluno')

@section('content')
    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Área do Aluno</h1>
    </div>

    {{-- Identificação da aula de hoje --}}
    <div class="container mx-auto px-4">

        {{-- Título + frase quando não há aulas --}}
        <div class="flex items-center ml-4 mt-4 mb-6 gap-5">
            <h2 class="font-bold text-[#6A239B] text-2xl">As aulas de hoje serão de:</h2>

            @if ($aulas->isEmpty())
                <span class="font-semibold text-[#6A239B] text-2xl">Não há aulas para hoje.</span>
            @endif
        </div>

        {{-- Aulas do dia --}}
        @if ($aulas->isNotEmpty())
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                @foreach ($aulas as $aula)
                    <div class="border p-5 rounded-2xl bg-[#d8c2e7] text-[#6A239B] min-w-[300px] max-w-md">
                        <p class="font-semibold text-center">
                            <span><strong>Formador(a):</strong> {{ $aula->formador->nome }}</span>
                            <span class="mx-2">|</span>
                            <span><strong>Módulo:</strong> {{ $aula->modulo->nome }}</span>
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>



    {{-- Mensagem de sucesso --}}
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-8">

        {{-- Check-in Tardio --}}
        <div class="flex flex-col rounded-2xl bg-[#7426AA] shadow-sm p-8 border border-slate-600">
            <div class="text-center">
                <p class="text-xl uppercase font-semibold text-[#EAEAEA]">CHECK-IN TARDIO</p>
            </div>
            <div class="mt-5">
                <button
                    class="w-full rounded-lg bg-white py-2 px-4 text-center text-lg font-bold text-[#7426AA] transition-all shadow-md hover:shadow-lg focus:bg-white/90 active:bg-white/90">
                    Faça agora
                </button>
            </div>
        </div>

        {{-- Check-out --}}
        <div class="flex flex-col rounded-2xl bg-[#40155E] shadow-sm p-8 border border-slate-600">
            <div class="text-center">
                <p class="text-xl uppercase font-semibold text-[#EAEAEA]">CHECK-OUT</p>
                <p class="text-md font-medium text-[#cfcdcd]">Para justificar a saída fora do horário</p>
            </div>
            <div class="mt-5">
                <button
                    class="w-full rounded-lg bg-white py-2 px-4 text-center text-lg font-bold text-[#40155E] transition-all shadow-md hover:shadow-lg focus:bg-white/90 active:bg-white/90">
                    Faça agora
                </button>
            </div>
        </div>


        {{-- Ausências --}}
        <div class="flex flex-col rounded-2xl bg-[#232526] shadow-sm p-8 border border-slate-600">
            <div class="text-center">
                <p class="text-xl uppercase font-semibold text-[#EAEAEA]">AS SUAS FALTAS</p>
            </div>
            <div class="mt-5">
                <button
                    class="w-full rounded-lg bg-white py-2 px-4 text-center text-lg font-bold text-[#232526] transition-all shadow-md hover:shadow-lg focus:bg-white/90 active:bg-white/90">
                    Verificar
                </button>
            </div>
        </div>
    @endsection
