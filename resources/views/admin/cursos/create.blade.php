<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Curso</title>

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
    
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">
            <div class="relative flex flex-col items-center justify-center text-white h-28 rounded-md bg-[#8154BF]">
                <h5 class="text-white text-3xl font-bold">
                    Criar Curso
                </h5>
            </div>
            <div class="p-6">
                <div class="block overflow-visible">

                    {{-- Mensagem de sucesso --}}
                    @if (session('mensagem-sucesso'))
                        <div class="flex justify-center mb-3">
                            <div role="alert"
                                class="alert alert-success alert-soft border border-green-400 transition transform duration-500 ease-in-out animate-fadeIn">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 shrink-0 stroke-current text-green-600" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-lg text-green-700 font-medium">{{ session('mensagem-sucesso') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Mensagem de erro --}}
                    @if (session('mensagem'))
                        <div class="flex justify-center mb-3">
                            <div role="alert"
                                class="alert alert-error alert-soft border border-red-400 transition transform duration-500 ease-in-out animate-fadeIn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-lg text-red-700 font-medium">{{ session('mensagem') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Formulário --}}
                    <form action="{{ route('admin.cursos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Nome --}}
                        <div class="mb-5">
                            <label for="nome" class="block text-lg text-[#8154BF] font-bold mb-2">Nome do Curso</label>
                            <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700 font-medium" required>
                            @error('nome')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Descrição --}}
                        <div class="mb-5">
                            <label for="descricao" class="block text-lg text-[#8154BF] font-bold mb-2">Descrição</label>
                            <div class="relative w-full min-w-[200px]">
                                <textarea name="descricao" id="descricao" rows="4"
                                    class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-gray-300 bg-gray-100 px-3 py-2.5 font-sans text-lg font-normal text-gray-800 outline-none focus:border-2 focus:border-[#8154BF]"
                                    placeholder=" ">{{ old('descricao') }}</textarea>
                                <label for="descricao"
                                    class="pointer-events-none absolute left-3 top-2 text-gray-500 transition-all peer-placeholder-shown:top-2.5 peer-placeholder-shown:text-gray-500 peer-focus:top-1 peer-focus:text-xs peer-focus:text-[#8154BF]">
                                    Descreva o curso
                                </label>
                            </div>
                        </div>

                        {{-- Botões --}}
                        <div class="flex justify-center items-center gap-4 mt-5">
                            <button type="submit"
                                class="bg-[#8154BF] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#6f49a2] focus:outline-none focus:ring">
                                Salvar
                            </button>

                            <a href="{{ route('admin.cursos.index') }}"
                                class="bg-[#232526] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#141616] focus:outline-none focus:ring">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
