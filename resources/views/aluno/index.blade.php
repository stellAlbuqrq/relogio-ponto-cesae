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
        <h1 class="ml-8 mt-4 mb-9 font-bold text-[#6A239B] text-4xl">Área do Aluno</h1>
    </div>

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


    </div>
@endsection
