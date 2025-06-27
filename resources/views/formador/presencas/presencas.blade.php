@extends('layouts.user-layout.formador-layout')

@section('content')
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css"> --}}
    <form method="GET" action="{{ route('formador.presencas') }}"
        class="flex flex-wrap gap-4 p-4 bg-white rounded-lg shadow mb-4">
        <div>
            <label class="block text-sm font-medium">Data Início</label>
            <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="input input-bordered">
        </div>

        <div>
            <label class="block text-sm font-medium">Data Fim</label>
            <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="input input-bordered">
        </div>

        <div>
            <label class="block text-sm font-medium">Módulo</label>
            <select name="modulo_id" class="input input-bordered">
                <option value="">Todos</option>
                @foreach ($modulos as $modulo)
                    <option value="{{ $modulo->id }}" {{ request('modulo_id') == $modulo->id ? 'selected' : '' }}>
                        {{ $modulo->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Aluno</label>
            <input type="text" name="aluno_nome" placeholder="Nome do aluno" value="{{ request('aluno_nome') }}"
                class="input input-bordered">
        </div>

        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="input input-bordered">
                <option value="">Todos</option>
                <option value="presente" {{ request('status') == 'presente' ? 'selected' : '' }}>Presente</option>
                <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="ausente" {{ request('status') == 'ausente' ? 'selected' : '' }}>Ausente</option>
            </select>
        </div>

        <div class="self-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>
    <div class="m-5">
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden">
            <div class="px-8 py-6 bg-gray-100 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-800">Histórico de Presenças</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-gray-800">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left min-w-[100px]">Data</th>
                            <th class="p-4 text-left min-w-[175px]">Módulo</th>
                            <th class="p-4 text-left min-w-[175px]">Aluno</th>
                            <th class="p-4 text-left min-w-[100px]">Check‑In</th>
                            <th class="p-4 text-left min-w-[100px]">Check‑Out</th>
                            <th class="p-4 text-left min-w-[100px]">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($historico as $presenca)
                            <tr class="border-b border-gray-200 even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4 text-left">
                                    {{ \Carbon\Carbon::parse($presenca->cronograma->data)->format('d/m/Y') }}
                                </td>
                                <td class="p-4 text-left">
                                    {{ $presenca->cronograma->modulo->nome }}
                                </td>
                                <td class="p-4 text-left">
                                    {{ $presenca->aluno?->nome ?? '-' }}
                                </td>

                                <td class="p-4 text-left">
                                    {{ $presenca->check_in ? \Carbon\Carbon::parse($presenca->check_in)->format('H:i') : '-' }}
                                </td>

                                <td class="p-4 text-left">
                                    {{ $presenca->check_out ? \Carbon\Carbon::parse($presenca->check_out)->format('H:i') : '-' }}
                                </td>
                                <td class="p-4 text-left">
                                    @switch($presenca->status)
                                        @case('presente')
                                            <span
                                                class="text-green-700 bg-green-100 rounded-lg px-4 py-2 font-semibold">Presente</span>
                                        @break

                                        @case('pendente')
                                            <span
                                                class="text-yellow-700 bg-yellow-100 rounded-lg px-4 py-2 font-semibold">Pendente</span>
                                        @break

                                        @case('ausente')
                                            <span class="text-red-700 bg-red-100 rounded-lg px-4 py-2 font-semibold">Ausente</span>
                                        @break

                                        @default
                                            <span
                                                class="text-gray-700 bg-gray-100 rounded-lg px-4 py-2 font-semibold">Desconhecido</span>
                                    @endswitch
                                </td>
                                </td>
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
            </div>
        </div>
    @endsection
