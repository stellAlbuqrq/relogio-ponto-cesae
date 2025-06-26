<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Layout acesso users</title>


</head>

<body>

    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
        :root {
            font-family: 'Inter', sans-serif;
        }

        @supports (font-variation-settings: normal) {
            :root {
                font-family: 'Inter var', sans-serif;
            }
        }
    </style>


    <div
        class="bg-slate-100 overflow-y-scroll w-screen h-screen antialiased text-slate-300 selection:bg-blue-600 selection:text-white">
        <div class="flex flex-col relative w-screen">
            <div id="menu"
                class="bg-gray-900 min-h-screen z-10 text-slate-300 w-64 fixed left-0 h-screen overflow-y-scroll">
                <div id="logo" class="my-4 px-6">
                    <h1 class="text-lg md:text-2xl font-bold text-white">Dash<span class="text-blue-500">8</span>.</h1>
                    <p class="text-slate-500 text-sm">Manage your actions and activities</p>
                </div>
                <div id="profile" class="px-6 py-10">
                    <p class="text-slate-500">Bem vindo(a),</p>
                    <a href="#" class="inline-flex space-x-2 items-center">
                        <span>
                            <img class="rounded-full w-8 h-8"
                                src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=128&q=80"
                                alt="">
                        </span>
                        <span class="text-sm md:text-base font-bold">
                            {{ auth()->user()->nome }}
                        </span>
                    </a>
                </div>
                <div id="nav" class="w-full px-6">
                    <a href="{{ route('aluno.dashboard') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 bg-blue-800 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>

                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg font-bold leading-5 text-white">Dashboard</span>
                            <span class="text-sm text-white/50 hidden md:block">Seus dados</span>
                        </div>
                    </a>
                    <a href="{{ route('aluno.presenca') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Presença</span>
                            <span class="text-sm text-slate-500 hidden md:block">Check-in</span>
                        </div>
                    </a>
                    <a href="{{ route('aluno.presenca-out') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Check-Out</span>
                            <span class="text-sm text-slate-500 hidden md:block">Sair antecipadamente</span>
                        </div>
                    </a>
                    <div class="w-full border-b border-slate-700">
                        <button onclick="toggleJustificacaoMenu()"
                            class="w-full px-2 inline-flex space-x-2 items-center py-3 hover:bg-white/5 transition ease-linear duration-150 focus:outline-none">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-lg text-slate-300 font-bold leading-5">Justificação</span>
                                <span class="text-sm text-slate-500 hidden md:block">Detalhes da falta</span>
                            </div>
                        </button>
                        {{-- <div id="justificacaoSubmenu" class="ml-8 mt-2 hidden flex flex-col space-y-2 pb-2">
                            <a href="{{ route('aluno.checkin-manual') }}"
                                class="text-slate-300 hover:text-white transition text-sm">Check-in Manual</a>
                            <a href="{{ route('aluno.justificacoes') }}"
                                class="text-slate-300 hover:text-white transition text-sm">Faltas</a>
                        </div> --}}
                    </div>
                    <a href="{{ route('aluno.cronograma') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Cronograma</span>
                            <span class="text-sm text-slate-500 hidden md:block">Detalhes de aula</span>
                        </div>
                    </a>
                    <a href="{{ route('aluno.historico') }}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Histórico</span>
                            <span class="text-sm text-slate-500 hidden md:block">Presenças e Faltas</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="min-h-screen flex items-center justify-center">
                @yield('content')
            </div>

        </div>
    </div>

    <script>
        function toggleJustificacaoMenu() {
            const submenu = document.getElementById('justificacaoSubmenu');
            submenu.classList.toggle('hidden');
        }
    </script>
</body>

</html>
