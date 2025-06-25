@extends('layouts.user-layout.admin-layout')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Criar Novo Usuário</h2>

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

        <form action="{{ route('admin.usuarios.store') }}" method="POST" class="bg-white p-6 rounded shadow-md space-y-6 w-full max-w-lg">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Tipo de usuário</label>
                <select name="role" id="role"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    <option value="">Selecione...</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="formador" {{ old('role') == 'formador' ? 'selected' : '' }}>Formador</option>
                    <option value="aluno" {{ old('role') == 'aluno' ? 'selected' : '' }}>Aluno</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.usuarios.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2 hover:bg-gray-400 transition">Cancelar</a>

                <button type="submit"
                        class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">
                    Criar Usuário
                </button>
            </div>
        </form>
    </div>
@endsection
