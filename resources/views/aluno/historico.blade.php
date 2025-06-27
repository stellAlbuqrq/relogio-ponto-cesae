@extends('layouts.paginaAluno')

@section('content')
    {{-- <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css"> --}}

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
                            <th class="p-4 text-left min-w-[175px]">Formador</th>
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
                                    {{ $presenca->cronograma->formador->nome }}
                                </td>
                                <td class="p-4 text-left">
                                    {{ $presenca->check_in ? $presenca->check_in->format('H:i') : '-' }}
                                </td>
                                <td class="p-4 text-left">
                                    {{ $presenca->check_out ? $presenca->check_out->format('H:i') : '-' }}
                                </td>
                                <td class="p-4 text-left">
                                    @switch($presenca->status)
                                        @case('presente')
                                            <span class="text-green-700 bg-green-100 rounded-lg px-4 py-2 font-semibold">
                                                Presente
                                            </span>
                                        @break

                                        @case('pendente')
                                            <span class="text-yellow-700 bg-yellow-100 rounded-lg px-4 py-2 font-semibold">
                                                Pendente
                                            </span>
                                        @break

                                        @case('ausente')
                                            <span class="text-red-700 bg-red-100 rounded-lg px-4 py-2 font-semibold">
                                                Ausente
                                            </span>
                                        @break

                                        @default
                                            <span class="text-gray-700 bg-gray-100 rounded-lg px-4 py-2 font-semibold">
                                                Desconhecido
                                            </span>
                                    @endswitch
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
