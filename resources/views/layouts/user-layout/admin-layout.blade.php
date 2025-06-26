<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin - Relógio de Ponto')</title>
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
                <h1 class="text-2xl font-bold text-white">Admin<span class="text-green-500">RP</span></h1>
                <p class="text-sm text-slate-400">Gestão do sistema</p>
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
                    <li><a href="{{ route('admin.dashboard') }}" class="block py-2 hover:text-green-400">📊
                            Dashboard</a></li>
                    <li><a href="{{ route('admin.usuarios.index') }}" class="block py-2 hover:text-green-400">👥
                            Usuários</a></li>
                    <li><a href="{{ route('admin.cursos.index') }}" class="block py-2 hover:text-green-400">🎓 Cursos</a></li>
                    <li><a href="{{ route('admin.turmas.index') }}" class="block py-2 hover:text-green-400">🏫 Turmas</a></li>
                    <li><a href="{{ route('admin.modulos.index') }}" class="block py-2 hover:text-green-400">📦 Módulos</a></li>
                    <li><a href="{{ route('admin.cronogramas.index') }}" class="block py-2 hover:text-green-400">🗓️ Cronograma</a></li>
                    <li><a href="{{ route('admin.presencas.index') }}" class="block py-2 hover:text-green-400">📝 Presenças</a></li>
                    <li><a href="{{ route('admin.relatorios.presencas.csv') }}"
                            class="block py-2 hover:text-green-400">📤 Relatório Presenças (CSV)</a></li>
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
