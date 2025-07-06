<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>

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
        <h1 class="ml-8 mt-4 mb-12 font-bold text-[#7426AA] text-4xl">Editar Cursos</h1>
    </div>


    <div class="relative items-center flex flex-col justify-center">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">

            <div class="p-6">
                <div class="block overflow-visible">
                    <div
                        class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">

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
                                        <span
                                            class="text-lg text-green-700 font-medium">{{ session('mensagem-sucesso') }}</span>
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
                            <form class="mt-3 flex flex-col" action="{{ route('admin.cursos.update', $curso) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf


                                {{-- Nome --}}
                                <div class="mb-5">
                                    <label class="block text-lg text-[#7426AA] font-bold mb-2">Nome do Curso</label>
                                    <input type="text" name="nome" id="nome"
                                        value="{{ old('nome', $curso->nome) }}"
                                        class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700 font-medium" required>
                                    @error('nome')
                                        <p class="text-red-500 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Comentário --}}
                                <div>
                                    <label for="descricao"
                                        class="block text-lg text-[#7426AA] font-bold mb-3 mt-5">Descrição</label>

                                </div>


                                <div>
                                    <div class="relative w-full min-w-[200px] mb-3">
                                        <textarea name="descricao" id="descricao" rows="4"
                                            class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-gray-300 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-lg font-normal text-gray-800 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"
                                            placeholder=" ">{{ old('descricao', $curso->descricao) }}</textarea>

                                        <label for="descricao"
                                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm
                                             peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-gray-500">
                                            Descreva o curso
                                        </label>
                                    </div>
                                </div>

                                {{-- Botões --}}
                                <div class="flex justify-center items-center gap-4 mt-5">
                                    <button type="submit"
                                        class="bg-[#7426AA] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#672a92] focus:outline-none focus:ring">
                                        Atualizar
                                    </button>

                                    <a href="{{ route('admin.cursos.index') }}"
                                        class="bg-[#232526] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#141616] focus:outline-none focus:ring">
                                        Cancelar
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
