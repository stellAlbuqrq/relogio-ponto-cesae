<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Formador - Relógio de Ponto')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
</head>

<body class="bg-slate-100 text-slate-800 antialiased selection:bg-green-600">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-white">Formador<span class="text-green-500">RP</span></h1>
                <p class="text-sm text-slate-400">Painel do Formador</p>
            </div>
            <div class="px-6 py-4 border-t border-slate-700">
                <p class="text-slate-500">Olá,</p>
                <div class="flex items-center space-x-2 mt-2">
                    <img class="w-8 h-8 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nome) }}" alt="Avatar">
                    <span class="font-semibold">{{ auth()->user()->nome }}</span>
                </div>
            </div>
            <nav class="mt-6 px-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('formador.pin') }}" class="block py-2 hover:text-green-400">
                            🔐 Disparar PIN
                        </a>
                    </li>
                     <li>
                        <a href="{{ route('formador.cronogramas.index') }}" class="block py-2 hover:text-green-400">
                            🔐 Cronogramas

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('formador.presencas') }}" class="block py-2 hover:text-green-400">
                            🔐 Presenças

                        </a>
                    </li>
                    {{-- Adicione outras rotas aqui se necessário --}}
                </ul>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-xl font-bold mb-6">@yield('title')</h2>
            @yield('content')
        </main>
    </div>
</body>

</html>
                    {{-- {{-- a href="{{route('formador.duracao-pin')}}"
                        class="w-full px-2 inline-flex space-x-2 items-center border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-lg text-slate-300 font-bold leading-5">Justificativas</span>
                            <span class="text-sm text-slate-500 hidden md:block"></span>
                        </div>
                    </a>

                    <!-- Log Out -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full px-2">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-2 border-b border-slate-700 py-3 hover:bg-white/5 transition ease-linear duration-150">
                            <div>
                                <svg class="w-6 h-6 fill-white" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
                                    </path>
                                </svg>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-white leading-5">Logout</span>
                            </div>
                        </button>
                    </form>
                </div>

            </div>
            <div class="min-h-screen flex items-center justify-center">
                @yield('content')
            </div>


        </div>
    </div>

</body>

</html> --}}
