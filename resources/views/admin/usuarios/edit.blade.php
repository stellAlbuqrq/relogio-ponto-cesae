<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>

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

    {{-- Container para centralizar --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-lg bg-white border border-slate-200 shadow-sm">
            <div class="relative flex flex-col items-center justify-center text-white h-28 rounded-md bg-[#AD87C6]">
                <h5 class="text-white text-3xl font-bold">
                    Edição de Usuário
                </h5>
            </div>
            <div class="p-6">

                {{-- Mensagem de sucesso --}}
                @if (session('mensagem-sucesso'))
                    <div class="flex justify-center mb-3">
                        <div role="alert"
                            class="alert alert-success alert-soft border border-green-400 transition transform duration-500 ease-in-out animate-fadeIn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current text-green-600"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-lg text-red-700 font-medium">{{ session('mensagem') }}</span>
                        </div>
                    </div>
                @endif

                <div class="block overflow-visible">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong>Erro:</strong>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div
                        class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">
                            <form class="mt-3 flex flex-col" action="{{ route('admin.usuarios.update', $usuario->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Nome --}}
                                <div class="mb-5">
                                    <label class="block text-lg text-[#AD87C6] font-bold mb-2">Nome</label>
                                    <input type="text" name="nome" id="nome"
                                        value="{{ old('nome', $usuario->nome) }}"
                                        class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700 font-medium" required>
                                </div>

                                {{-- Email --}}
                                <div class="mb-5">
                                    <label for="email" class="block text-lg text-[#AD87C6] font-bold mb-2">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $usuario->email) }}"
                                        class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700 font-medium" required>
                                </div>

                                {{-- Senha --}}
                                <div class="mb-5">
                                    <label for="password" class="block text-lg text-[#AD87C6] font-bold mb-2">Senha (preencha
                                        apenas se quiser alterar)</label>
                                    <input type="password" name="password" id="password"
                                        class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700 font-medium">
                                </div>

                                {{-- Tipo de usuário --}}
                                <div class="w-full mb-5">
                                    <label class="block text-lg text-[#AD87C6] font-bold mb-2">Tipo de usuário</label>
                                    <div class="relative">
                                        <select name="role" id="role"
                                            class="w-full bg-gray-100 rounded text-gray-700 text-sm pl-3 pr-8 py-2 border border-slate-200 focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer"
                                            required>
                                            <option value="">Selecione...</option>
                                            <option value="admin"
                                                {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Administrador
                                            </option>
                                            <option value="formador"
                                                {{ old('role', $usuario->role) == 'formador' ? 'selected' : '' }}>Formador
                                            </option>
                                            <option value="aluno"
                                                {{ old('role', $usuario->role) == 'aluno' ? 'selected' : '' }}>Aluno
                                            </option>
                                        </select>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.2" stroke="currentColor"
                                            class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700 pointer-events-none">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </div>
                                </div>

                                {{-- Botões --}}
                                <div class="flex justify-center items-center gap-4 mt-5">
                                    <button type="submit"
                                        class="bg-[#AD87C6] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#8d6ca3] focus:outline-none focus:ring">
                                        Atualizar Usuário
                                    </button>

                                    <a href="{{ route('admin.usuarios.index') }}"
                                        class="bg-[#232526] text-white font-semibold px-4 py-2 rounded-lg hover:bg-[#141616] focus:outline-none focus:ring">
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
