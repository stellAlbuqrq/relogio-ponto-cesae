@extends('layouts.user-layout.admin-layout')

@section('content')
    <div class="container mx-auto px-6 py-8 max-w-xl">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detalhes do Usuário</h2>

        <div class="bg-white p-6 rounded shadow-md space-y-4">
            <div>
                <strong class="text-gray-600">Nome:</strong>
                <p class="text-gray-800">{{ $usuario->nome }}</p>
            </div>

            <div>
                <strong class="text-gray-600">Email:</strong>
                <p class="text-gray-800">{{ $usuario->email }}</p>
            </div>

            <div>
                <strong class="text-gray-600">Tipo de Usuário:</strong>
                <p class="text-gray-800 capitalize">{{ $usuario->role }}</p>
            </div>

            <div>
                <strong class="text-gray-600">Criado em:</strong>
                <p class="text-gray-800">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div>
                <strong class="text-gray-600">Última atualização:</strong>
                <p class="text-gray-800">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('admin.usuarios.index') }}"
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                    Voltar
                </a>

                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Editar
                </a>
            </div>
        </div>
    </div>
@endsection
