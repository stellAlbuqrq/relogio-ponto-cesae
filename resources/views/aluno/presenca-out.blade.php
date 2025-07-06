<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-out Antecipado</title>

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

@extends('layouts.paginaAluno')

@section('content')
    <div>
        <h1 class="ml-8 mt-4 mb-12 font-bold text-[#40155E] text-4xl">Faça o seu check-out</h1>
    </div>

    {{-- Formulário --}}
    <div class="relative items-center flex flex-col justify-center">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">
            <div class="relative items-center flex flex-col justify-center text-white h-28 rounded-md bg-[#232526]">
                <h5 class="text-white text-3xl font-bold">Check-out Antecipado</h5>
            </div>

            <div class="p-6">

                {{-- Mensagem de sucesso --}}
                @if (session('mensagem-sucesso'))
                    <div class="flex justify-center mb-3">
                        <div role="alert"
                            class="alert alert-success alert-soft border border-green-400 transition transform duration-500 ease-in-out animate-fadeIn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current text-green-600"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-lg text-green-700 font-medium">{{ session('mensagem-sucesso') }}</span>
                        </div>
                    </div>
                @endif

                {{-- Mensagem de erro --}}
                @if (session('mensagem'))
                    <div class="flex justify-center mb-3">
                        <div role="alert"
                            class="alert alert-error alert-soft border border-red-400 transition transform duration-500 ease-in-out animate-fadeIn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-lg text-red-700 font-medium">{{ session('mensagem') }}</span>
                        </div>
                    </div>
                @endif

                <div class="block overflow-visible">
                    <div class="relative block w-full overflow-x-hidden overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">
                            <form class="mt-3 flex flex-col" action="{{ route('aluno.checkout') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                {{-- Hora --}}
                                <div class="mb-5">
                                    <div id="hora" class="w-full px-3 py-2 font-bold text-4xl text-center"></div>
                                </div>

                                {{-- Data --}}
                                <div class="mb-5">
                                    <p class="block text-lg text-[#232526] font-bold">Data</p>
                                    <div id="data" class="w-full px-3 py-2 text-gray-700 font-bold"></div>
                                </div>

                                {{-- Módulo --}}
                                <div class="mb-5">
                                    <p class="block text-lg text-[#232526] font-bold mb-2">Módulo</p>
                                    @if ($cronograma && $cronograma->formador && $cronograma->modulo)
                                        <div
                                            class="px-3 py-2 bg-[#efe4f7] rounded text-[#232526] font-semibold text-center">
                                            {{ $cronograma->formador->nome }} –
                                            <strong>{{ $cronograma->modulo->nome }}</strong>
                                        </div>
                                    @else
                                        <div
                                            class="px-3 py-2 bg-[#f1ecf4] rounded text-[#232526] font-semibold text-center">
                                            Informação de módulo indisponível.
                                        </div>
                                    @endif
                                </div>

                                {{-- Comentário --}}
                                <div>
                                    <label for="comentario"
                                        class="block mb-2 text-lg text-[#232526] font-bold">Justificação</label>

                                    <div class="relative w-full min-w-[200px] mb-3">
                                        <textarea id="comentario" name="comentario" rows="4"
                                            class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-gray-300 border-t-transparent bg-transparent px-3 py-2.5 text-lg font-normal text-gray-800 outline-0 transition-all placeholder-shown:border-blue-gray-200 focus:border-2 focus:border-gray-900"
                                            placeholder=" "></textarea>

                                        <label for="comentario"
                                            class="pointer-events-none absolute left-0 -top-1.5 w-full select-none text-[11px] leading-tight text-gray-500 transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-gray-500 peer-focus:text-[11px] peer-focus:text-gray-900">
                                            Escreva a sua justificação aqui...
                                        </label>
                                    </div>
                                </div>

                                {{-- Botão --}}
                                <div class="relative items-center flex flex-col justify-center mb-2">
                                    <button type="submit" name="acao" value="check_out"
                                        class="w-fit bg-[#232526] text-white font-semibold px-4 py-2 rounded-lg mt-5 hover:bg-[#131414] focus:outline-none focus:ring">
                                        Check-out
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Script para hora e data --}}
    <script>
        function mostrarHoraData() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString();
            const data = agora.toLocaleDateString();

            document.getElementById('hora').textContent = hora;
            document.getElementById('data').textContent = data;
        }

        mostrarHoraData();
        setInterval(mostrarHoraData, 1000);
    </script>
@endsection
