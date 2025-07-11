<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador | CESAE Digital</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('imagens/cesae-digital-icone.png') }}" type="image/png">

    <!-- Tipografia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <style>
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

        .rotate-0 {
            transform: rotate(0deg);
        }

        .transition-transform {
            transition: transform 0.3s ease;
            transform-origin: center;
        }
    </style>

</head>

<body class="font-['Nunito Sans']">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-[19rem] bg-[#4b4657] text-white">
            <div class="flex flex-col h-full p-4">

                <!-- Logo -->
                <div class="flex justify-center mb-6 mt-5">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('imagens/cesae-digital-pb.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                </div>

                <!-- Nome do Administrador -->
                <h5 class="text-center text-xl font-bold mb-6">
                    Bem-vindo(a), {{ auth()->user()->nome }}!
                </h5>

                <!-- Itens do menu -->
                <div class="flex flex-col flex-grow">

                    <!-- Usuários -->
                    <div class="mb-2 flex items-center p-3 font-bold text-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-[25px] h-[25px] fill-[#eaeaea]" viewBox="0 0 640 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z">
                                </path>
                            </svg>
                            <a href="{{ route('admin.usuarios.index') }}">Usuários</a>
                        </div>
                    </div>

                    <!-- Educacional -->
                    <div class="mb-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-semibold text-left hover:text-white"
                            data-menu="educacional">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[25px] h-[25px] fill-[#eaeaea]" viewBox="0 0 640 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M160 64c0-35.3 28.7-64 64-64H576c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H336.8c-11.8-25.5-29.9-47.5-52.4-64H384V320c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v32h64V64L224 64v49.1C205.2 102.2 183.3 96 160 96V64zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352h53.3C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7H26.7C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z">
                                    </path>
                                </svg>
                            </div>
                            <span class="mr-auto text-xl">Educacional</span>
                            <svg id="arrow-educacional" class="w-4 h-4 transition-transform rotate-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                        <div id="submenu-educacional" class="submenu ml-6 mt-2 flex flex-col gap-1 text-lg">
                            <a href="{{ route('admin.cursos.index') }}">Cursos</a>
                            <a href="{{ route('admin.turmas.index') }}">Turmas</a>
                            <a href="{{ route('admin.modulos.index') }}">Módulos</a>
                        </div>
                    </div>

                    <!-- Presença -->
                    <div class="mb-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-3 font-semibold text-left hover:text-white"
                            data-menu="presenca">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[25px] h-[25px] fill-[#eaeaea]" viewBox="0 0 448 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM329 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L329 305z">
                                    </path>
                                </svg>
                            </div>
                            <span class="mr-auto text-xl">Presença</span>
                            <svg id="arrow-presenca" class="w-4 h-4 transition-transform rotate-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>

                        </button>
                        <div id="submenu-presenca" class="submenu ml-6 mt-2 flex flex-col gap-1 text-lg">
                            <a href="{{ route('admin.presencas.index') }}">Presenças de Alunos</a>
                            <a href="{{ route('admin.relatorios.presencas.csv') }}">Relatório de Presenças (CSV)</a>
                        </div>
                    </div>


                    <!-- Cronograma -->
                    <div class="mb-2 flex items-center p-3 font-bold text-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-[25px] h-[25px] fill-[#eaeaea]" viewBox="0 0 448 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192z">
                                </path>
                            </svg>
                            <a href="{{ route('admin.cronogramas.index') }}">Cronograma</a>
                        </div>
                    </div>

                    <!-- Espaço inferior -->
                    <div class="flex-grow"></div>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}">
                        <div
                            class="flex items-center w-full p-2 hover:bg-blue-gray-50 hover:text-white transition-all cursor-pointer font-bold">
                            <div class="grid mr-4 place-items-center">
                                <svg class="w-[20px] h-[20px] fill-[#eaeaea]" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>
                                </svg>
                            </div>
                            @csrf
                            <button type="submit" class="text-white text-xl">Log Out</button>
                        </div>
                    </form>
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

                if (arrow.classList.contains('rotate-180')) {
                    arrow.classList.remove('rotate-180');
                    arrow.classList.add('rotate-0');
                } else {
                    arrow.classList.remove('rotate-0');
                    arrow.classList.add('rotate-180');
                }
            });
        });
        
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</body>

</html>
