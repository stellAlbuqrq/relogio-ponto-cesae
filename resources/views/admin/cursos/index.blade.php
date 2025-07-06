<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>

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
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#8154BF] text-4xl">Lista de Cursos</h1>
    </div>

    {{-- Botão Novo Curso --}}
    <div class="mb-6 flex justify-end mr-5">
        <a href="{{ route('admin.cursos.create') }}" class="bg-[#40155E] text-white px-4 py-2 rounded-lg">+ Novo Curso</a>
    </div>

    {{-- Tabela --}}
    <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-md text-gray-800">
                <thead class="bg-[#8154BF] text-white">
                    <tr>
                        <th class="p-4 text-center min-w-[100px]">ID</th>
                        <th class="p-4 text-center min-w-[110px]">Nome</th>
                        <th class="p-4 text-center min-w-[140px]">Descrição</th>
                        <th class="p-4 text-center min-w-[140px]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cursos as $curso)
                        <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                            <td class="p-4 text-center bg-[#9564da] text-white">{{ $curso->id }}</td>
                            <td class="p-4 text-center">{{ $curso->nome }}</td>
                            <td class="p-4 text-center">{{ $curso->descricao }}</td>
                            <td class="px-5 py-6 text-center text-md">
                                <div class="flex justify-center gap-2">
                                    {{-- Botão Editar --}}
                                    <a href="{{ route('admin.cursos.edit', $curso) }}"
                                        class="bg-[#9564da] hover:bg-[#8559c3] text-white font-semibold px-3 py-2 rounded-lg">
                                        Editar
                                    </a>

                                    {{-- Botão Excluir --}}
                                    <form action="{{ route('admin.cursos.destroy', $curso) }}" method="POST"
                                        onsubmit="return confirm('Deseja excluir este curso?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-[#40155E] hover:bg-[#34114e] text-white font-semibold px-3 py-2 rounded-lg">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-500">
                                Ainda não há cursos registados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
