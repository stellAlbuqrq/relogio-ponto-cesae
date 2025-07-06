<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar o Módulo</title>

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

    <div class="min-h-screen flex items-center justify-center">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">
            <div class="relative flex flex-col items-center justify-center text-white h-28 rounded-md bg-[#7426AA]">
                <h5 class="text-white text-3xl font-bold">Criar novo Módulo</h5>
            </div>

            <div class="p-6">
                {{-- Mensagens --}}
                @if (session('mensagem-sucesso'))
                    <div class="flex justify-center mb-3">
                        <div role="alert" class="alert alert-success alert-soft border border-green-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current text-green-600"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-lg text-green-700 font-medium">{{ session('mensagem-sucesso') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('mensagem'))
                    <div class="flex justify-center mb-3">
                        <div role="alert" class="alert alert-error alert-soft border border-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-lg text-red-700 font-medium">{{ session('mensagem') }}</span>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulário --}}
                <form action="{{ route('admin.modulos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-5">
                        <label for="nome" class="block text-lg text-[#7426AA] font-bold mb-2">Nome do Módulo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}"
                            class="w-full px-3 py-2 bg-white border border-gray-400 rounded text-gray-700 font-medium focus:border-gray-500 focus:outline-none"
                            required>
                        @error('nome')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Turma --}}
                    <div class="mb-5">
                        <label for="turma_id" class="block text-lg text-[#7426AA] font-bold mb-2">Turma</label>
                        <div class="relative">
                            <select name="turma_id"
                                class="w-full bg-white border border-gray-300 text-gray-700 text-sm rounded px-3 py-2 focus:border-gray-500 focus:outline-none shadow-sm appearance-none cursor-pointer"
                                required>
                                <option value="">Selecione</option>
                                @foreach ($turmas as $turma)
                                    <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                                @endforeach
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                                stroke="currentColor"
                                class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </div>
                    </div>

                    {{-- Formador --}}
                    <div class="mb-5">
                        <label for="formador_id" class="block text-lg text-[#7426AA] font-bold mb-2">Formador</label>
                        <div class="relative">
                            <select name="formador_id"
                                class="w-full bg-white border border-gray-300 text-gray-700 text-sm rounded px-3 py-2 focus:border-gray-500 focus:outline-none shadow-sm appearance-none cursor-pointer"
                                required>
                                <option value="">Selecione</option>
                                @foreach ($formadores as $formador)
                                    <option value="{{ $formador->id }}">{{ $formador->nome }}</option>
                                @endforeach
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                                stroke="currentColor"
                                class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700 pointer-events-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </div>
                    </div>

                    {{-- Carga Horária --}}
                    <div class="mb-5">
                        <label for="carga_horaria" class="block text-lg text-[#7426AA] font-bold mb-2">Carga Horária
                            (horas)</label>
                        <input type="number" name="carga_horaria" value="{{ old('carga_horaria') }}"
                            class="w-full px-3 py-2 bg-white border border-gray-400 rounded text-gray-700 font-medium focus:border-gray-500 focus:outline-none"
                            required>
                        @error('carga_horaria')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex justify-center items-center gap-4 mt-5">
                        <button type="submit"
                            class="bg-[#7426AA] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#5d2188] focus:outline-none focus:ring">
                            Salvar
                        </button>

                        <a href="{{ route('admin.modulos.index') }}"
                            class="bg-[#232526] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#141616] focus:outline-none focus:ring">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
