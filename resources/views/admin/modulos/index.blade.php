<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Módulos</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    {{-- Daisy UI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

</head>

@extends('layouts.paginaAdministrador')

@section('content')

    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#4b4657] text-4xl">Lista de Módulos</h1>
    </div>

    {{-- Botão --}}
    <div class="mb-6 flex justify-end mr-5">
        <a href="{{ route('admin.modulos.create') }}" class="bg-[#7426AA] text-white px-4 py-2 rounded-lg">+ Criar
            Módulo</a>
    </div>

    @if (session('success'))
        <div class="flex justify-center items-center">
            <div class="bg-green-100 text-green-800 px-5 py-3 rounded-lg mb-4 w-fit text-center text-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if ($modulos->isEmpty())
        <p>Nenhum módulo cadastrado.</p>
    @else
        {{-- Tabela --}}
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden mt-4">
            <div class="overflow-x-auto">
                <table class="w-full text-md text-gray-800">
                    <thead class="bg-[#4b4657] text-white">
                        <tr>
                            <th class="p-4 text-center min-w-[100px]">ID</th>
                            <th class="p-4 text-center min-w-[110px]">Nome</th>
                            <th class="p-4 text-center min-w-[140px]">Turma</th>
                            <th class="p-4 text-center min-w-[140px]">Formador</th>
                            <th class="p-4 text-center min-w-[140px]">Carga Horária</th>
                            <th class="p-4 text-center min-w-[140px]">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($modulos as $modulo)
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4 text-center bg-[#5c586b] text-white">{{ $modulo->id }}</td>
                                <td class="p-4 text-center">{{ $modulo->nome }}</td>
                                <td class="p-4 text-center">
                                    {{ $modulo->turma->nome ?? '—' }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $modulo->formador->nome ?? '—' }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $modulo->carga_horaria }}h
                                </td>

                                <td class="px-5 py-6 text-center text-md">
                                    <div class="flex justify-center gap-2">
                                        {{-- Botão Ver --}}
                                        <a href="{{ route('admin.modulos.show', $modulo) }}"
                                            class="bg-[#7426AA] hover:bg-[#66308d] text-white font-semibold px-3 py-2 rounded-lg">
                                            Ver
                                        </a>

                                        {{-- Botão Editar --}}
                                        <a href="{{ route('admin.modulos.edit', $modulo) }}"
                                            class="bg-[#9564da] hover:bg-[#8559c3] text-white font-semibold px-3 py-2 rounded-lg">
                                            Editar
                                        </a>

                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.modulos.destroy', $modulo) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir?')"
                                                class="bg-[#40155E] hover:bg-[#34114e] text-white font-semibold px-3 py-2 rounded-lg"
                                                onsubmit="return confirm('Excluir este módulo?');">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
    @endif
    </tbody>
    </table>
    </div>
    </div>






    {{-- <div class="p-6 max-w-6xl mx-auto">

        <h1 class="text-2xl font-bold mb-4">Lista de Módulos</h1>

        <a href="{{ route('admin.modulos.create') }}"
            class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Criar Módulo
        </a>

        @if (session('success'))
            <div class="mb-4 bg-green-200 text-green-800 p-3 rounded">{{ session('success') }}</div>
        @endif

        @if ($modulos->isEmpty())
            <p>Nenhum módulo cadastrado.</p>
        @else
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">ID</th>
                        <th class="px-3 py-2 border">Nome</th>
                        <th class="px-3 py-2 border">Turma</th>
                        <th class="px-3 py-2 border">Formador</th>
                        <th class="px-3 py-2 border">Carga Horária</th>
                        <th class="px-3 py-2 border">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modulos as $modulo)
                        <tr>
                            <td class="border px-3 py-2">{{ $modulo->id }}</td>
                            <td class="border px-3 py-2">{{ $modulo->nome }}</td>
                            <td class="border px-3 py-2">{{ $modulo->turma->nome ?? '—' }}</td>
                            <td class="border px-3 py-2">{{ $modulo->formador->nome ?? '—' }}</td>
                            <td class="border px-3 py-2">{{ $modulo->carga_horaria }}h</td>
                            <td class="border px-3 py-2 space-x-2">
                                <a href="{{ route('admin.modulos.show', $modulo) }}"
                                    class="text-blue-600 hover:underline">Ver</a>
                                <a href="{{ route('admin.modulos.edit', $modulo) }}"
                                    class="text-yellow-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.modulos.destroy', $modulo) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Excluir este módulo?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif --}}

    </div>
@endsection
