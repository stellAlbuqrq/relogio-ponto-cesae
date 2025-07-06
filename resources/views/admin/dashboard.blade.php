<head>
    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

</head>

@extends('layouts.paginaAdministrador')

@section('content')
    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Área do Administrador</h1>
    </div>
    <div class="flex justify-center items-center text-center">
        <h2 class="font-bold text-[#232526] text-2xl ml-8 mb-3">Estatísticas Gerais</h2>
    </div>

    <div class=" mb-16">
        <div class="grid-cols-1 md:grid-cols-3 gap-5 flex justify-center items-center text-center">
            <div class="bg-white rounded-lg shadow-md px-9 py-2">
                <h3 class="text-gray-600 font-semibold">Usuários</h3>
                <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md px-9 py-2">
                <h3 class="text-gray-600 font-semibold">Cursos</h3>
                <p class="text-2xl font-bold">{{ \App\Models\Curso::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md px-9 py-2">
                <h3 class="text-gray-600 font-semibold">Presenças</h3>
                <p class="text-2xl font-bold">{{ \App\Models\Presenca::count() }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-center items-center text-center">
        <h2 class="font-bold text-[#232526] text-2xl ml-8 mb-3">Próximas Tarefas</h2>
    </div>

    <div class="flex justify-center items-center text-center">
        <p class="font-medium text-[#515151] bg-[#d4b9fa] text-lg ml-8 mb-3 p-4 rounded-lg shadow-md">Não há tarefas</p>
    </div>
@endsection
