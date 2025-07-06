<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Turmas</title>

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
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#7426AA] text-4xl">Lista de Turmas</h1>
    </div>

    {{-- Botão Nova Turma --}}
    <div class="mb-6 flex justify-end mr-5">
        <a href="{{ route('admin.turmas.create') }}" class="bg-[#7426AA] text-white px-4 py-2 rounded-lg">Nova Turma</a>
    </div>

        @if (session('success'))
        <div class="flex justify-center items-center">
            <div class="bg-green-100 text-green-800 px-5 py-3 rounded-lg mb-4 w-fit text-center text-lg">
                {{ session('success') }}
            </div>
            </div>
        @endif

    {{-- Tabela --}}
    <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden mt-4">
        <div class="overflow-x-auto">
            <table class="w-full text-md text-gray-800">
                <thead class="bg-[#7426AA] text-white">
                    <tr>
                        <th class="p-4 text-center min-w-[100px]">Nome</th>
                        <th class="p-4 text-center min-w-[110px]">Curso</th>
                        <th class="p-4 text-center min-w-[140px]">Início</th>
                        <th class="p-4 text-center min-w-[140px]">Fim</th>
                        <th class="p-4 text-center min-w-[140px]">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($turmas->isEmpty())
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Ainda não há turmas registadas.
                            </td>
                        </tr>
                    @else
                        @foreach ($turmas as $turma)
                            @php
                                $datas = $turma->cronogramas->pluck('data')->sort();
                                $dataInicio = $datas->first();
                                $dataFim = $datas->last();
                            @endphp
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4 text-center bg-[#7f29bd] text-white">{{ $turma->nome }}</td>
                                <td class="p-4 text-center">{{ $turma->curso->nome }}</td>
                                <td class="p-4 text-center">
                                    {{ $dataInicio ? \Carbon\Carbon::parse($dataInicio)->format('d/m/Y') : '—' }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $dataFim ? \Carbon\Carbon::parse($dataFim)->format('d/m/Y') : '—' }}
                                </td>
                                <td class="px-5 py-6 text-center text-md">
                                    <div class="flex justify-center gap-2">
                                        {{-- Botão Ver --}}
                                        <a href="{{ route('admin.turmas.show', $turma) }}"
                                            class="bg-[#7426AA] hover:bg-[#66308d] text-white font-semibold px-3 py-2 rounded-lg">
                                            Ver
                                        </a>

                                        {{-- Botão Editar --}}
                                        <a href="{{ route('admin.turmas.edit', $turma) }}"
                                            class="bg-[#9564da] hover:bg-[#8559c3] text-white font-semibold px-3 py-2 rounded-lg">
                                            Editar
                                        </a>

                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.turmas.destroy', $turma) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Tem certeza que deseja excluir?')"
                                                class="bg-[#40155E] hover:bg-[#34114e] text-white font-semibold px-3 py-2 rounded-lg">
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
@endsection
