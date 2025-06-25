@extends('layouts.user-layout.admin-layout')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Usuários</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('admin.usuarios.create') }}"
               class="bg-green-600 text-black px-4 py-2 rounded hover:bg-green-700 transition">
                + Novo Usuário
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase font-medium">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nome</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $usuario->id }}</td>
                            <td class="px-4 py-3">{{ $usuario->nome }}</td>
                            <td class="px-4 py-3">{{ $usuario->email }}</td>
                            <td class="px-4 py-3 capitalize">{{ $usuario->role }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.usuarios.edit', $usuario->id) }}"
                                   class="text-blue-600 hover:underline">Editar</a>

                                <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($usuarios->isEmpty())
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
@endsection
