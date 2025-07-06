<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

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
    <div class="container mx-auto px-6 py-8">
        <div>
            <h1 class="ml-8 mt-4 mb-8 font-bold text-[#232526] text-4xl">Edição de Usuários</h1>
        </div>

        @if (session('success'))
        <div class="flex justify-center items-center">
            <div class="bg-green-100 text-green-800 px-5 py-3 rounded-lg mb-4 w-fit text-center text-lg">
                {{ session('success') }}
            </div>
            </div>
        @endif

        {{-- Botão Novo Usuário --}}
        <div class="mb-6 flex justify-end">
            <a href="{{ route('admin.usuarios.create') }}"
                class="bg-[#6A239B] text-white py-3.5 px-4 rounded-lg hover:bg-[#5a1e81] font-semibold transition flex items-center gap-2">
                <span class="text-2xl font-bold">+</span> Novo Usuário
            </a>
        </div>


        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-md text-gray-800">
                    <thead class="bg-[#4b4657] text-white">
                        <tr class="m-5">
                            <th class="px-2 py-4 text-center min-w-[80px]">#</th>
                            <th class="px-2 py-4 text-center min-w-[110px]">Nome</th>
                            <th class="px-2 py-4 text-center min-w-[140px]">Email</th>
                            <th class="px-2 py-4 text-center min-w-[100px]">Role</th>
                            <th class="px-2 py-4 text-center min-w-[140px]">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="px-2 py-2 text-center bg-[#5c586b] text-white">
                                    {{ $usuario->id }}
                                </td>
                                <td class="px-2 py-2 text-center">
                                    {{ $usuario->nome }}
                                </td>
                                <td class="px-2 py-2 text-center">
                                    {{ $usuario->email }}
                                </td>
                                <td class="px-2 py-2 text-center">
                                    {{ $usuario->role }}
                                </td>
                                <td class="px-2 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                                            class="bg-[#6A239B] hover:bg-[#5a1e81] text-white font-semibold px-3 py-2 rounded-lg">
                                            Editar
                                        </a>
                                        <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario->id) }}"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-[#AD87C6] hover:bg-[#9573ac] text-white font-semibold px-3 py-2 rounded-lg">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        @if ($usuarios->isEmpty())
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                    Nenhum usuário encontrado.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
