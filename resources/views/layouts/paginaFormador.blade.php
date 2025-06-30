<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formador | CESAE Digital</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('imagens/cesae-digital-icone.png') }}" type="image/png">

    {{-- Tipografia --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <style>
        /* Para que funcione as animações dos subitens */
        .submenu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .submenu.open {
            max-height: 500px;
            opacity: 1;
        }

        .submenu a {
            opacity: 0;
            transform: translateX(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .submenu.open a {
            opacity: 1;
            transform: translateX(0);
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .transition-transform {
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body class="font-['Nunito Sans']">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-[19rem] bg-[#EAEAEA] text-[#6A239B]">
            <div class="flex flex-col h-full p-4">

                <!-- Logo -->
                <div class="flex justify-center mb-6 mt-5">
                    {{-- Rota --}}
                    <a href="{{ route('formador.dashboard') }}">
                        <img src="{{ asset('imagens/cesae-digital-logo.svg') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                </div>

                <!-- Nome do Formador -->
                <h5 class="text-center text-xl font-bold mb-6">
                    Bem-vindo, {{ auth()->user()->nome }}!
                </h5>

                <!-- Itens do menu -->
                <div class="flex flex-col flex-grow">


                    {{-- Botão Inserir PIN --}}
                    <a class="font-bold text-2xl text-center text-[#EAEAEA] mb-5" href="{{ route('formador.pin') }}">
                        <button
                            class="rounded-2xl bg-[#6A239B] py-3 px-12 transition-all shadow-md shadow-[#9c67c4] hover:shadow-lg hover:shadow-[#6A239B] hover:bg-[#7a31ab] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                            type="button">
                            Gerar PIN
                        </button>
                    </a>


                    <!-- Botão Presença -->
                    <div class="mb-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-bold text-left hover:text-[#6c3594]"
                            data-menu="atividades">
                            <div class="grid mr-4 place-items-center">
                                {{-- Icone --}}
                                <svg class="w-[25px] h-[25px] fill-[#7426aa]" viewBox="0 0 448 512"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z">
                                    </path>

                                </svg>
                            </div>
                            <span class="mr-auto text-xl">Presença</span>
                            <svg id="arrow-atividades" class="w-4 h-4 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        {{-- Subitens --}}
                        <div id="submenu-atividades"
                            class="submenu ml-6 mt-2 flex flex-col gap-1 text-lg font-semibold">
                            <a href="{{ route('aluno.presenca') }}">Conferir Presença</a>
                            <a href="{{ route('formador.justificacoes') }}">Conferir Falta Justificada</a>
                            <a href="{{ route('formador.presencas') }}">Histórico</a>
                            {{-- <a href="{{ route('aluno.presenca-out') }}">Check-out Antecipado</a> --}}
                        </div>
                    </div>

                    {{-- Cronograma --}}
                    <div class="mb-2 flex items-center p-3 font-bold text-xl">
                        <div class="flex items-center space-x-3">
                            {{-- Icone --}}
                            <svg class="w-[25px] h-[25px] fill-[#7426aa]" viewBox="0 0 448 512"
                                xmlns="http://www.w3.org/2000/svg">

                                <path
                                    d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z">
                                </path>

                            </svg>


                            <a href="{{ route('cronogramas.index') }}">Cronograma</a>
                        </div>
                    </div>

                    <!-- Deixa os botões no final da página -->
                    <div class="flex-grow"></div>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        <div
                            class="flex items-center w-full p-2 hover:bg-blue-gray-50 hover:text-white transition-all cursor-pointer font-bold">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[20px] h-[20px] fill-[#7426AA]" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>

                                </svg>
                            </div>

                            @csrf
                            <button type="submit" class="text-[#7426AA] text-xl">Log Out</button>
                    </form>
                </div>

            </div>
    </div>
    </aside>

    <!-- Conteúdo principal -->
    <main class="flex-1 p-6 bg-[#e1dbf0]">
        @yield('content')
    </main>

    </div>

    <script>
        // Para permitir o movimento do menu e dos subitens (de expandir e recolher)
        document.querySelectorAll('[data-menu]').forEach(button => {
            button.addEventListener('click', () => {
                const key = button.getAttribute('data-menu');
                const submenu = document.getElementById('submenu-' + key);
                const arrow = document.getElementById('arrow-' + key);
                submenu.classList.toggle('open');
                arrow.classList.toggle('rotate-180');
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>

</html>
