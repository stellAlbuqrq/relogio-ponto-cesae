@extends('layouts.user-layout.formador-layout')

@section('content')
    <div class="m-5">
        {{-- Mensagem de erro --}}
        @if (session('mensagem'))
            <div class="mb-4 flex items-start space-x-3 bg-red-100 border border-red-200 text-red-800 rounded p-4">
                <svg class="w-5 h-5 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l5.518 9.815c.75 1.333-.213 3.086-1.742 3.086H4.48c-1.53 0-2.492-1.753-1.742-3.086L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-8a1 1 0 00-.894.553l-.5 1a1 1 0 001.788.894l.5-1A1 1 0 0010 5z" />
                </svg>
                <div class="flex-1 text-sm">
                    {{ session('mensagem') }}
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="text-red-500 hover:text-red-700 focus:outline-none">
                    &times;
                </button>
            </div>
        @endif

        {{-- Mensagem de sucesso --}}
    @if (session('mensagem-sucesso'))
        <div class="flex items-start space-x-3 bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 shadow-sm">
            <svg class="w-6 h-6 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L9 12.293l6.293-6.293a1 1 0 011.414 0z" />
            </svg>
            <div class="flex-1 text-sm font-medium">
                {{ session('mensagem-sucesso') }}
            </div>
            <button type="button" onclick="this.parentElement.remove()"
                class="text-green-500 hover:text-green-700 focus:outline-none text-lg font-bold leading-none">
                &times;
            </button>
        </div>
    @endif

        {{-- View principal --}}
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden">
            <div class="px-8 py-6 bg-gray-100 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Validação das Justificações</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-800">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left">Data</th>
                            <th class="p-4 text-left">Módulo</th>
                            <th class="p-4 text-left">Aluno</th>
                            <th class="p-4 text-left">Período</th>
                            <th class="p-4 text-left">Comentário</th>
                            <th class="p-4 text-left">Anexo</th>
                            <th class="p-4 text-left">Status</th>
                            <th class="p-4 text-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($justificacoes as $justificacao)
                            <tr class="border-b border-gray-200 even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4">
                                    {{ $justificacao->data_justificada ? $justificacao->data_justificada->format('d/m/Y') : '-' }}
                                </td>
                                <td class="p-4">
                                    {{ Str::limit($justificacao->cronograma->modulo->nome ?? '-', 40, '...') }}
                                </td>
                                <td class="p-4">{{ $justificacao->aluno->nome ?? '-' }}</td>
                                <td class="p-4">{{ ucfirst($justificacao->periodo) }}</td>
                                <td class="p-4">
                                    {{ Str::limit($justificacao->texto, 50, '...') }}
                                </td>
                                <td class="p-4">
                                    @if ($justificacao->anexo)
                                        <a href="{{ asset('storage/' . $justificacao->anexo) }}" target="_blank"
                                            class="text-blue-600 underline">Ficheiro</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="p-4">
                                    @switch($justificacao->status)
                                        @case('aprovada')
                                            <span
                                                class="text-green-700 bg-green-100 rounded-lg px-4 py-1 font-semibold">Aprovada</span>
                                        @break

                                        @case('pendente')
                                            <span
                                                class="text-yellow-700 bg-yellow-100 rounded-lg px-4 py-1 font-semibold">Pendente</span>
                                        @break

                                        @case('recusada')
                                            <span
                                                class="text-red-700 bg-red-100 rounded-lg px-4 py-1 font-semibold">Recusada</span>
                                        @break
                                    @endswitch
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('formador.justificacoes-aceitar', $justificacao) }}">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white font-semibold px-3 py-1 rounded-lg text-sm">
                                                Aceitar
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('formador.justificacoes-rejeitar', $justificacao) }}">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-semibold px-3 py-1 rounded-lg text-sm">
                                                Rejeitar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="p-6 text-center text-gray-500">Ainda não há justificações
                                    registadas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
