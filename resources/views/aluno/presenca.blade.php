<head>
    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

</head>


@extends('layouts.paginaNeutra')

@section('content')
    <div class="min-h-screen flex items-center justify-center font-[Nunito Sans]">
        <div class="mx-auto w-1/2 px-28 rounded-lg bg-white p-6 shadow-4 dark:bg-surface-dark">

            <!-- Logo -->
            <div class="text-center mb-10 mt-5">
                <img class="mx-auto w-60" src="{{ asset('imagens/cesae-digital-logo.svg') }}" alt="Logo" />
                <h4 class="mt-10 mb-2 text-3xl text-[#6A239B] font-bold">Faça o seu check-in</h4>
            </div>

            <form action="{{ route('aluno.checkin') }}" method="POST">
                @csrf
                {{-- <h1 class="text-5xl font-bold text-center mb-11 text-[#6A239B]">Check-in</h1> --}}

                <div class="flex justify-center gap-20 text-center mb-4 text-2xl">

                    <!--Data-->
                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <p class="block text-[#6A239B] font-bold">Data</p>
                        <div id="data" class="w-full px-3 text-[#232526]"></div>
                    </div>

                    <!--Horário-->
                    <div class="relative mb-6" data-twe-input-wrapper-init>
                        <p class="block text-[#6A239B] font-bold">Horário</p>
                        <div id="hora" class="w-full px-3 text-[#232526] font-semibold"></div>
                    </div>
                </div>

                {{-- Módulo --}}
                <div>
                    <p class="block text-lg text-[#6A239B] font-bold">Módulo</p>
                    <div class="px-3 py-2 bg-[#efe4f7] rounded text-[#232526] font-semibold text-center">
                        {{ $cronograma->formador->nome }} – <strong>{{ $cronograma->modulo->nome }}</strong>
                    </div>
                </div>

                {{-- PIN --}}
                <label for="pinInserido" class="block text-lg text-[#6A239B] font-bold mt-5 mb-2">Insira o PIN</label>
                <div class="relative mb-3" data-twe-input-wrapper-init>
                    <input id="pinInserido" name="pinInserido" type="text" inputmode="numeric" pattern="\d{4}"
                        minlength="4" required placeholder="0000" maxlength="4"
                        class="peer block min-h-[auto] w-full rounded border-2 bg-transparent border-[#6A239B] focus:outline px-3 py-[0.32rem] leading-[1.6] outline-none transition-all text-center text-2xl font-semibold duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0"
                        placeholder="PIN" />
                    <label for="pinInserido"
                        class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-center text-neutral-600 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[twe-input-state-active]:-translate-y-[0.9rem] peer-data-[twe-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary">O
                        seu PIN
                    </label>
                </div>

                {{-- Botão --}}
                <div class="relative items-center flex flex-col justify-center mb-2">
                    <button type="submit" name="acao" value="check_in"
                        class="w-fit bg-[#40155E] text-white font-semibold px-5 py-3 text-lg rounded-lg mt-5 hover:bg-[#36194b] focus:outline-none focus:ring">
                        Check‑in
                    </button>
                </div>


            </form>
            <div class="text-center">
                <p>
                    Se já realizou o check-in, ignore esta página e vá para a
                    <a href="{{ route('aluno.dashboard') }}"
                        class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600">página
                        inicial!</a>

                </p>

            </div>

        </div>


    </div>
    {{-- <form action="{{ route('aluno.checkin') }}" method="POST">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold text-center">Check In</h2>

            Hora
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Hora</p>
                <div id="hora" class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700"></div>
            </div>

            Data
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Data</p>
                <div id="data" class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700"></div>
            </div>

            Módulo
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Módulo</p>
                @if (@isset($cronograma))
                <div class="px-3 py-2 bg-gray-100 rounded text-gray-700">
                    {{ $cronograma->formador->nome }} – {{ $cronograma->modulo->nome }}
                </div>
            @else
                <div class="px-3 py-2 bg-gray-100 rounded text-gray-700 text-red-600">
                    Hoje não há aula.
                </div>
            @endif

        PIN
        <div>
            <label for="pinInserido" class="block text-gray-700 text-sm font-bold mb-1">Insira o PIN</label>
            <input id="pinInserido" name="pinInserido" type="text" inputmode="numeric" pattern="\d{4}" maxlength="4"
                minlength="4" required placeholder="0000"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300">
        </div>

        Botão
        <button type="submit" name="acao" value="check_in"
            class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring">
            Check‑in
        </button>

        {{-- Mensagem de erro --}}
        @if (session('mensagem'))
            <div class="flex items-start space-x-3 bg-red-100 border border-red-200 text-red-800 rounded p-4">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l5.518 9.815c.75 1.333-.213 3.086-1.742 3.086H4.48c-1.53 0-2.492-1.753-1.742-3.086L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-8a1 1 0 00-.894.553l-.5 1a1 1 0 001.788.894l.5-1A1 1 0 0010 5z" />
                </svg>
                <div class="flex-1 text-sm">
                    {{ session('mensagem') }}
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="text-red-500 hover:text-red-700 focus:outline-none">
                    &times;
                </button>
            </div>
        @endif

    {{-- mensagem de check in manual --}}
    @if (session('checkin'))
        <a href="{{ route('aluno.checkin-manual') }}" @method('GET')>
            <div
                class="bg-white border border-slate-300 w-max h-20 shadow-lg rounded-md gap-4 p-4 flex flex-row items-center justify-center">
                <section class="w-6 h-full flex flex-col items-center justify-start">
                    <svg width="100%" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 15s1.5-2 4-2 4 2 4 2" />
                        <line x1="9" y1="9" x2="9.01" y2="9" />
                        <line x1="15" y1="9" x2="15.01" y2="9" />
                    </svg>
                </section>
                <section class="h-full flex flex-col items-start justify-end gap-1">
                    <h1 class="text-base font-semibold text-zinc-800 antialiased">{{ session('checkin') }}</h1>
                    <p class="text-sm font-medium text-zinc-400 antialiased">Clique aqui para Check-in tardio</p>
                </section>
                <section class="w-5 h-full flex flex-col items-center justify-start">
                    <svg width="100%" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="cursor-pointer">
                        <path
                            d="M4.06585 3.00507C3.77296 2.71218 3.29809 2.71218 3.00519 3.00507C2.7123 3.29796 2.7123 3.77284 3.00519 4.06573L4.06585 3.00507ZM10.0763 11.1368C10.3692 11.4297 10.844 11.4297 11.1369 11.1368C11.4298 10.8439 11.4298 10.369 11.1369 10.0761L10.0763 11.1368ZM3.00519 4.06573L10.0763 11.1368L11.1369 10.0761L4.06585 3.00507L3.00519 4.06573Z"
                            fill="#989fac" />
                        <path
                            d="M11.1369 4.06573C11.4298 3.77284 11.4298 3.29796 11.1369 3.00507C10.844 2.71218 10.3691 2.71218 10.0762 3.00507L11.1369 4.06573ZM3.00517 10.0761C2.71228 10.369 2.71228 10.8439 3.00517 11.1368C3.29806 11.4297 3.77294 11.4297 4.06583 11.1368L3.00517 10.0761ZM10.0762 3.00507L3.00517 10.0761L4.06583 11.1368L11.1369 4.06573L10.0762 3.00507Z"
                            fill="#989fac" />
                    </svg>
                </section>
            </div>

            </a>
        @endif




        <script>
            //Função que mostra a hora/data no front-end (a hora/data a ser guardada na Tabela presença será a hora definida no Back-end)
            function mostrarHoraData() {
                const agora = new Date();
                const hora = agora.toLocaleTimeString();
                const data = agora.toLocaleDateString();

                document.getElementById('hora').textContent = hora;
                document.getElementById('data').textContent = data;
            }


            mostrarHoraData(); //Atualiza o método ao carregar a página

            setInterval(() => { //Atualiza a cada segundo que passa
                mostrarHoraData();
            }, 1000);
        </script>
    @endsection
