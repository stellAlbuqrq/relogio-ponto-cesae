<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESAE Digital</title>

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
        <aside class="w-[19rem] bg-[#190E40] text-white">
            <div class="flex flex-col h-full p-4">

                <!-- Logo -->
                <div class="flex justify-center mb-6 mt-5">
                    <a href="/">
                        <img src="{{ asset('imagens/cesae-digital-pb.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                </div>

                <!-- Nome do Aluno -->
                <h5 class="text-center text-xl font-bold mb-6">
                    Bem-vindo, {{ auth()->user()->nome }}!
                </h5>

                <!-- Itens do menu -->
                <div class="flex flex-col flex-grow">

                    <!-- Botão Atividades -->
                    <div class="mb-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-semibold text-left hover:text-white"
                            data-menu="atividades">
                            <div class="grid mr-4 place-items-center">
                                {{-- Icone --}}
                                <svg class="w-5 h-5 fill-[#eaeaea]" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                                </svg>
                            </div>
                            <span class="mr-auto text-xl">Atividades</span>
                            <svg id="arrow-atividades" class="w-4 h-4 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        {{-- Subitens --}}
                        <div id="submenu-atividades" class="submenu ml-6 mt-2 flex flex-col gap-1 text-lg">
                            <a href="{{ route('aluno.presenca') }}">Check-in</a>
                            <a href="{{ route('aluno.checkin-manual') }}">Check-in Tardio</a>
                            <a href="{{ route('aluno.presenca-out') }}">Check-out Antecipado</a>
                        </div>
                    </div>

                    <!-- Botão Aluno -->
                    <div class="mb-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-semibold text-left hover:text-white"
                            data-menu="aluno">
                            <div class="grid mr-4 place-items-center">
                                {{-- Icone --}}
                                <svg class="w-5 h-5 fill-[#eaeaea]" viewBox="0 0 448 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                </svg>
                            </div>
                            <span class="mr-auto text-xl">Aluno</span>
                            <svg id="arrow-aluno" class="w-4 h-4 transition-transform" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        {{-- Subitens --}}
                        <div id="submenu-aluno" class="submenu ml-6 mt-2 flex flex-col gap-1 text-lg">
                            <a href="{{ route('aluno.justificacoes') }}">Faltas</a>
                            <a href="{{ route('aluno.historico') }}">Histórico</a>
                            <a href="{{ route('aluno.cronograma') }}">Cronograma</a>
                        </div>
                    </div>

                    <!-- Deixa os botões no final da página -->
                    <div class="flex-grow"></div>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        <div
                            class="flex items-center w-full p-2 hover:bg-blue-gray-50 hover:text-white transition-all cursor-pointer font-semibold">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[20px] h-[20px] fill-[#eaeaea]" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                        <div
                            class="flex items-center w-full p-2 hover:bg-blue-gray-50 hover:text-white transition-all cursor-pointer font-semibold">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[20px] h-[20px] fill-[#eaeaea]" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>

                                </svg>
                            </div>
                                </svg>
                            </div>

                            @csrf
                            <button type="submit" class="text-white text-xl">Log Out</button>
                    </form>
                </div>

            </div>
    </div>
    </aside>
            </div>
    </div>
    </aside>

    <!-- Conteúdo principal -->
    <main class="flex-1 p-6 bg-[#f1eeee]">
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
