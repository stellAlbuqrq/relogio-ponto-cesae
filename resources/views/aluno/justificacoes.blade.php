<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justificar faltas</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Tipografia --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    {{-- Calendário --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    {{-- Daisy UI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

</head>

@extends('layouts.paginaAluno')

@section('content')
    <div>
        <h1 class="ml-8 mt-4 mb-12 font-bold text-[#AD87C6] text-4xl">Justifique as suas faltas</h1>
    </div>


    <div class="relative items-center flex flex-col justify-center">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">
            <div class="relative items-center flex flex-col justify-center text-white h-28 rounded-md bg-[#AD87C6]">
                <h5 class="text-white text-3xl font-bold">
                    Justificação de Faltas
                </h5>
            </div>
            <div class="p-6">
                <div class="block overflow-visible">
                    <div
                        class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">

                            {{-- Mensagem de sucesso --}}
                            @if (session('mensagem-sucesso'))
                                <div class="flex justify-center mb-3">
                                    <div role="alert"
                                        class="alert alert-success alert-soft border border-green-400 transition transform duration-500 ease-in-out animate-fadeIn">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 shrink-0 stroke-current text-green-600" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span
                                            class="text-lg text-green-700 font-medium">{{ session('mensagem-sucesso') }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Mensagem de erro --}}
                            @if (session('mensagem'))
                                <div class="flex justify-center mb-3">
                                    <div role="alert"
                                        class="alert alert-error alert-soft border border-red-400 transition transform duration-500 ease-in-out animate-fadeIn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-lg text-red-700 font-medium">{{ session('mensagem') }}</span>
                                    </div>
                                </div>
                            @endif

                            {{-- Formulário --}}
                            <form class="mt-3 flex flex-col" action="{{ route('aluno.justificacoes-guardar') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Selecione a data --}}
                                <div>
                                    <label for="date-picker"
                                        class="block text-lg text-[#AD87C6] font-bold mb-3 mt-5">Selecione a data</label>
                                </div>

                                <div class="relative h-10 w-full min-w-[200px]">
                                    <input id="date-picker" name="data_justificada" type="text"
                                        class="peer h-10 w-full rounded-[7px] border border-gray-300 bg-transparent px-3 py-2.5 text-lg text-gray-800 placeholder-transparent
               focus:border-2 focus:border-[#AD87C6] focus:outline-none focus:border-t-transparent"
                                        placeholder=" " value="{{ old('data_justificada') }}" />
                                    <label for="date-picker"
                                        class="pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none truncate text-[11px] font-normal leading-tight text-gray-500 transition-all
               before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all
               after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all
               peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent
               peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-[#AD87C6] peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-[#AD87C6]
               peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-[#AD87C6]">
                                        Escolha a data
                                    </label>
                                </div>



                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                                <div class="mb-5">
                                    <div id="hora"
                                        class="w-full px-3 py-2 font-bold text-4xl relative items-center flex flex-col justify-center">
                                    </div>
                                </div>

                                {{-- Período --}}
                                <div>
                                    <p class="block text-lg text-[#AD87C6] font-bold mb-3">Selecione o período</p>
                                    <div class="flex justify-between gap-2">

                                        <div class="flex gap-10">
                                            <div class="inline-flex items-center">
                                                <label class="relative flex items-center cursor-pointer" for="manha">
                                                    <input type="radio" name="periodo" id="manha" value="manha"
                                                        class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all">
                                                    {{ old('periodo', $justificacao->periodo ?? '') == 'manha' ? 'checked' : '' }}

                                                    <span
                                                        class="absolute bg-[#40155E] w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                    </span>
                                                </label>
                                                <label class="ml-2 text-slate-600 cursor-pointer text-md font-medium"
                                                    for="manha">Manhã</label>
                                            </div>

                                            <div class="inline-flex items-center">
                                                <label class="relative flex items-center cursor-pointer" for="tarde">
                                                    <input type="radio" name="periodo" id="tarde" value="tarde"
                                                        type="radio"
                                                        class="peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all">
                                                    {{ old('periodo', $justificacao->periodo ?? '') == 'tarde' ? 'checked' : '' }}
                                                    <span
                                                        class="absolute bg-[#40155E] w-3 h-3 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity duration-200 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                    </span>
                                                </label>
                                                <label class="ml-2 text-slate-600 cursor-pointer text-md font-medium"
                                                    for="tarde">Tarde</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- Comentário --}}
                                <p class="text-sm text-gray-500 mt-2">* Caso dia todo, crie <strong>duas
                                        justificações</strong> (uma para manhã e outra para tarde).</p>

                                <div>
                                    <label for="comentario"
                                        class="block text-lg text-[#AD87C6] font-bold mb-3 mt-5">Justificação</label>

                                </div>


                                <div>
                                    <div class="relative w-full min-w-[200px] mb-3">
                                        <textarea id="comentario" name="comentario" rows="4"
                                            class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-gray-300 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-lg font-normal text-gray-800 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"
                                            placeholder=" "></textarea>

                                        <label for="comentario"
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm
                                             peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-gray-500">
                                            Escreva a sua justificação aqui...
                                        </label>
                                    </div>
                                </div>

                                {{-- Anexo --}}
                                <div>
                                    <label for="anexo" class="block text-lg text-[#AD87C6] font-bold mb-3 mt-5">Anexo
                                        (imagem
                                        ou PDF)</label>
                                    <input type="file" name="anexo" id="anexo" accept="image/*,application/pdf"
                                        class="file-input file-input-neutral rounded-md w-full" />
                                </div>

                                {{-- Botão --}}
                                <div class="relative items-center flex flex-col justify-center mb-2 mt-2">
                                    <button type="submit" name="justificar" value="justificar"
                                        class="w-fit bg-[#AD87C6] text-white text-lg font-semibold px-7 py-3 rounded-lg mt-5 hover:bg-[#a276c0] focus:outline-none focus:ring">
                                        Enviar
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- from node_modules -->
    <script src="node_modules/@material-tailwind/html@latest/scripts/ripple.js"></script>

    <!-- from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>


    <script>
        flatpickr("#date-picker", {
            dateFormat: "Y-m-d"
        });

        const datepicker = flatpickr("#date-picker", {});

        const calendarContainer = datepicker.calendarContainer;
        const calendarMonthNav = datepicker.monthNav;
        const calendarNextMonthNav = datepicker.nextMonthNav;
        const calendarPrevMonthNav = datepicker.prevMonthNav;
        const calendarDaysContainer = datepicker.daysContainer;

        calendarContainer.className =
            `${calendarContainer.className} bg-white p-4 border border-blue-gray-50 rounded-lg shadow-lg shadow-blue-gray-500/10 font-sans text-sm font-normal text-blue-gray-500 focus:outline-none break-words whitespace-normal`;

        calendarMonthNav.className =
            `${calendarMonthNav.className} flex items-center justify-between mb-4 [&>div.flatpickr-month]:-translate-y-3`;

        calendarNextMonthNav.className =
            `${calendarNextMonthNav.className} absolute !top-2.5 !right-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

        calendarPrevMonthNav.className =
            `${calendarPrevMonthNav.className} absolute !top-2.5 !left-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

        calendarDaysContainer.className =
            `${calendarDaysContainer.className} [&_span.flatpickr-day]:!rounded-md [&_span.flatpickr-day.selected]:!bg-gray-900 [&_span.flatpickr-day.selected]:!border-gray-900`;
    </script>
@endsection
