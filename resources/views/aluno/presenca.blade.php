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


            {{-- Mensagem de sucesso --}}
            @if (session('mensagem-sucesso'))
                <div class="flex justify-center">
                    <div
                        class="flex items-start space-x-3 bg-green-100 border border-green-200 text-green-800
                    rounded-lg p-4 text-lg font-medium w-fit">
                        <svg class="w-6 h-6 flex-shrink-0 text-green-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L9 12.293l6.293-6.293a1 1 0 011.414 0z" />
                        </svg>
                        <div>
                            {{ session('mensagem-sucesso') }}
                        </div>
                        <button type="button" onclick="this.parentElement.remove()"
                            class="text-green-500 hover:text-green-700 focus:outline-none text-xl leading-none self-start">
                            &times;
                        </button>
                    </div>
                </div>
            @endif

            {{-- Mensagem de erro --}}
            @if (session('mensagem'))
                <div class="flex justify-center">
                    <div
                        class="flex items-start space-x-3 bg-red-100 border border-red-200 text-red-800
        rounded-lg p-4 text-base font-medium w-fit">
                        <svg class="w-5 h-5 flex-shrink-0 text-red-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l5.518 9.815c.75 1.333-.213 3.086-1.742 3.086H4.48c-1.53 0-2.492-1.753-1.742-3.086L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-8a1 1 0 00-.894.553l-.5 1a1 1 0 001.788.894l.5-1A1 1 0 0010 5z" />
                        </svg>
                        <div>
                            {{ session('mensagem') }}
                        </div>
                        <button type="button" onclick="this.parentElement.remove()"
                            class="text-red-500 hover:text-red-700 focus:outline-none text-lg leading-none self-start">
                            &times;
                        </button>
                    </div>
                </div>
            @endif


            {{-- mensagem de check in manual --}}
            @if (session('checkin'))
                <div class="flex justify-center">
                    <a href="{{ route('aluno.checkin-manual') }}">
                        <div
                            class="flex items-start space-x-3 bg-yellow-100 border border-yellow-200 text-yellow-800
        rounded-lg p-4 text-base font-medium w-fit">
                            <svg class="w-5 h-5 flex-shrink-0 text-yellow-600 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm.75-14v4.25l3 3-.75.75-3.5-3.5V8h1.25z" />
                            </svg>
                            <div>
                                <h1 class="font-semibold">{{ session('checkin') }}</h1>
                                <p class="text-sm font-normal text-yellow-700 mt-1">Clique aqui para realizar o Check-in
                                    tardio</p>
                            </div>
                            <button type="button" onclick="this.parentElement.remove()"
                                class="text-yellow-500 hover:text-yellow-700 focus:outline-none text-lg leading-none self-start">
                                &times;
                            </button>
                        </div>
                    </a>
                </div>
            @endif


            <!-- Logo -->
            <div class="text-center mb-10 mt-5">
                <img class="mx-auto w-60" src="{{ asset('imagens/cesae-digital-logo.svg') }}" alt="Logo" />
                <h4 class="mt-10 mb-2 text-3xl text-[#6A239B] font-bold">Faça o seu check-in</h4>
            </div>

            <form action="{{ route('aluno.checkin') }}" method="POST">
                @csrf

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
                    @if ($cronograma && $cronograma->formador && $cronograma->modulo)
                        <div class="px-3 py-2 bg-[#efe4f7] rounded text-[#232526] font-semibold text-center">
                            {{ $cronograma->formador->nome }} – <strong>{{ $cronograma->modulo->nome }}</strong>
                        </div>
                    @else
                        <div class="px-3 py-2 bg-[#efe4f7] rounded text-[#232526] font-semibold text-center">
                            Informação de módulo indisponível.
                        </div>
                    @endif
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





    <script>
        //Função que mostra a hora/data no front-end (a hora/data a ser guardada na Tabela presença será a hora definida no Back-end)
        function mostrarHoraData() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString();
            const data = agora.toLocaleDateString();

            document.getElementById('hora').textContent = hora;
            document.getElementById('data').textContent = data;
        }


        mostrarHoraData(); 

        setInterval(() => { //Atualiza a cada segundo que passa
            mostrarHoraData();
        }, 1000);
    </script>
@endsection
