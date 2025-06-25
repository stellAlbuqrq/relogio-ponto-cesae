@extends('layouts.user-layout.aluno-layout')

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
                            <th class="p-4 text-left min-w-[100px]">Justificar</th>
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
                                    @if ($presenca->acao === 'check_in')
                                        {{ $presenca->created_at->format('H:i') }}
                                    @endif
                                </td>
                                <td class="p-4 text-left">
                                    @if ($presenca->acao === 'check_out')
                                        {{ $presenca->created_at->format('H:i') }}
                                    @endif
                                </td>
                                <td class="p-4 text-left">

                                </td>
                                <td class="p-4 text-center">
                                    <button class="text-blue-600 hover:text-blue-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15M4.5 12h15" />
                                        </svg>
                                    </button>
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
