<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Presenças</title>

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
    <div class="w-full p-6">

        <div>
            <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Lista de Presenças</h1>
        </div>

        {{-- Tabela --}}
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden mt-4">
            <div class="overflow-x-auto">
                <table class="w-full text-md text-gray-800">
                    <thead class="bg-[#6A239B] text-white">
                        <tr>
                            <th class="p-4 text-center min-w-[100px]">Aluno</th>
                            <th class="p-4 text-center min-w-[110px]">Cronograma</th>
                            <th class="p-4 text-center min-w-[140px]">Ação</th>
                            <th class="p-4 text-center min-w-[140px]">PIN</th>
                            <th class="p-4 text-center min-w-[140px]">Comentário</th>
                            <th class="p-4 text-center min-w-[160px]">Registado em</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presencas as $presenca)
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4 text-center"><strong>{{ $presenca->aluno->nome ?? '—' }}</strong></td>
                                <td class="p-4 text-center">{{ $presenca->cronograma->modulo->nome ?? '—' }}</td>
                                <td class="p-4 text-center">{{ ucfirst($presenca->acao) }}</td>
                                <td class="p-4 text-center">{{ $presenca->pin ?? '—' }}</td>
                                <td class="p-4 text-center">{{ $presenca->comentario ?? '—' }}</td>
                                <td class="p-4 text-center">{{ $presenca->registrado_em}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-gray-500">
                                    Ainda não há presenças registadas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="p-4 flex justify-center">
                {{ $presencas->appends(request()->query())->links('pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
