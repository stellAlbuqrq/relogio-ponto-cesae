<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Presenças</title>

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

@extends('layouts.paginaFormador')

@section('content')
    <div>
        <h1 class="ml-8 mt-7 mb-9 font-bold text-[#6A239B] text-4xl">Histórico de Presenças</h1>
    </div>

    {{-- Filtro --}}
    <div class=" bg-white w-fit rounded-lg shadow items-center mx-auto">
        <form method="GET" action="{{ route('formador.presencas') }}"
            class="flex items-center justify-center gap-4 p-4 mb-4 font-texto overflow-x-auto">
            <div>
                <label class="block text-md font-semibold">Data Início</label>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

                <div class="relative h-10 w-full min-w-[200px]">
                    <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" " />
                    <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">

                    </label>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            </div>

            <div>
                <label class="block text-md font-semibold">Data Fim</label>

                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

                <div class="relative h-10 w-full min-w-[200px]">
                    <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                        placeholder=" " />
                    <label
                        class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">

                    </label>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

            </div>

            <div>
                <label class="block text-md font-semibold">Módulo</label>

                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <select name="modulo_id"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-black-800 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option value="">Todos</option>
                            @foreach ($modulos as $modulo)
                                <option value="{{ $modulo->id }}"
                                    {{ request('modulo_id') == $modulo->id ? 'selected' : '' }}>
                                    {{ $modulo->nome }}
                                </option>
                            @endforeach
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                            stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-md font-semibold">Aluno</label>

                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <input type="text" name="aluno_nome" placeholder="Nome do aluno"
                            value="{{ request('aluno_nome') }}"
                            class="peer w-full bg-transparent placeholder:text-slate-500 text-slate-700 text-sm border border-black-700 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" />
                        <label
                            class="absolute cursor-text bg-white px-1 left-2.5 top-2.5 text-slate-400 text-sm transition-all transform origin-left peer-focus:-top-2 peer-focus:left-2.5 peer-focus:text-xs peer-focus:text-slate-400 peer-focus:scale-90">

                        </label>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-md font-semibold">Status</label>

                <div class="w-full max-w-sm min-w-[100px]">
                    <div class="relative">
                        <select name="status"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-black-800 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option value="">Todos</option>
                            <option value="presente" {{ request('status') == 'presente' ? 'selected' : '' }}>Presente
                            </option>
                            <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente
                            </option>
                            <option value="ausente" {{ request('status') == 'ausente' ? 'selected' : '' }}>Ausente</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                            stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <button
                    class="rounded-lg bg-[#6A239B] py-2 px-4 border border-transparent text-center text-md text-white transition-all shadow-md hover:shadow-lg focus:bg-[#602f81] focus:shadow-none active:bg-[#602f81] hover:bg-[#602f81] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="submit">
                    Filtrar
                </button>

                <a href="{{ route('formador.presencas') }}"
                    class="rounded-lg bg-[#AD87C6] py-2 px-4 border border-transparent text-center text-md text-white transition-all shadow-md hover:shadow-lg focus:bg-[#a67dc2] focus:shadow-none active:bg-[#a67dc2] hover:bg-[#a67dc2] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                    type="submit">
                    Limpar

                </a>
            </div>

        </form>
    </div>


    {{-- Tabela --}}
    <div class="m-5">
        <div class="bg-white rounded-2xl border border-stone-300 shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-md text-gray-800">
                    <thead class="bg-[#40155E] text-white">
                        <tr>
                            <th class="p-4 text-center min-w-[100px]">Data</th>
                            <th class="p-4 text-center min-w-[110px]">Módulo</th>
                            <th class="p-4 text-center min-w-[140px]">Aluno</th>
                            <th class="p-4 text-center min-w-[100px]">Check‑In</th>
                            <th class="p-4 text-center min-w-[100px]">Check‑Out</th>
                            <th class="p-4 text-center min-w-[100px]">Status</th>
                            <th class="p-4 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($historico as $presenca)
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-100 hover:bg-gray-200 transition">
                                <td class="p-4 text-center bg-[#4c1970] text-white">
                                    {{ \Carbon\Carbon::parse($presenca->cronograma->data)->format('d/m/Y') }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $presenca->cronograma->modulo->nome }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $presenca->aluno?->nome ?? '-' }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $presenca->check_in ? \Carbon\Carbon::parse($presenca->check_in)->format('H:i') : '-' }}
                                </td>
                                <td class="p-4 text-center">
                                    {{ $presenca->check_out ? \Carbon\Carbon::parse($presenca->check_out)->format('H:i') : '-' }}
                                </td>
                                <td class="p-4 text-center">
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
                                <td class="p-4 text-center text-lg">
                                    <button
                                        class="rounded-md bg-[#40155E] py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-[#35164b] focus:shadow-none hover:bg-[#35164b] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                                        onclick="openModal(
        '{{ $presenca->id ?? '' }}',               {{-- O ID do registro de check-in --}}
        '{{ $presenca->check_in ?? '' }}',        {{-- Já é a string H:i ou null --}}
        '{{ $presenca->check_out ?? '' }}',       {{-- Já é a string H:i ou null --}}
        '{{ $presenca->cronograma->id }}',
        '{{ $presenca->cronograma->hora_inicio }}'
    )">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6 text-center text-gray-500">
                                        Ainda não há presenças registadas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- Modal de Edição -->
        <div id="modal-editar-presenca"
            class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-2xl text-[#6A239B] font-bold mb-5 text-center">Editar Presença</h2>

                <form method="POST" action="{{ route('formador.presenca.atualizar') }}" onsubmit="return validarHorario()">
                    @csrf
                    <input type="hidden" name="presenca_id" id="modal-presenca-id">

                    <label for="check_in" class="block mb-2 text-md font-semibold text-gray-900">Novo Check-In</label>
                    <input type="time" name="check_in" id="modal-check-in" class="input input-bordered w-full mb-1"
                        required />

                    <p id="erro-checkin" class="text-sm text-red-600 hidden mb-3">O horário deve estar entre 09:00–13:00 ou
                        14:00–17:00.</p>

                    <label for="check_out" class="block mb-2 text-md font-semibold text-gray-900">Novo Check-out</label>
                    <input type="time" name="check_out" id="modal-check-out" class="input input-bordered w-full mb-1"
                        required />

                    <p id="erro-checkout" class="text-sm text-red-600 hidden mb-3">O horário deve estar entre 09:00–13:00 ou
                        14:00–17:00.</p>

                    <label for="comentario" class="block mb-2 text-md font-semibold text-gray-900">Justificativa</label>
                    <textarea id="modal-comentario" name="comentario" rows="3" required
                        class="input input-bordered w-full h-24 mb-5"></textarea>

                    <div class="flex justify-center gap-4">
                        <button type="submit" class="btn bg-[#6A239B] text-white p-4 rounded-lg">Salvar Alterações</button>
                        <button type="button" onclick="closeModal()" class="btn bg-gray-700 text-white p-4 rounded-lg">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            let periodoAtual = '';

            function openModal(id, checkIn, checkOut, cronogramaId, horaInicio) {
                document.getElementById('modal-presenca-id').value = id;
                document.getElementById('modal-check-in').value = checkIn?.slice(11, 16) ?? '';
                document.getElementById('modal-check-out').value = checkOut?.slice(11, 16) ?? '';
                document.getElementById('modal-comentario').value = '';
                document.getElementById('modal-editar-presenca').classList.remove('hidden');

                // Definir período com base na hora_inicio
                if (horaInicio < '13:00:00') {
                    periodoAtual = 'manha';
                } else {
                    periodoAtual = 'tarde';
                }
            }

            function closeModal() {
                document.getElementById('modal-editar-presenca').classList.add('hidden');
            }


            function validarHorario() {
                const checkInEl = document.getElementById('modal-check-in');
                const checkOutEl = document.getElementById('modal-check-out');
                const erroCheckIn = document.getElementById('erro-checkin');
                const erroCheckOut = document.getElementById('erro-checkout');

                const checkIn = checkInEl.value;
                const checkOut = checkOutEl.value;

                const [hIn, mIn] = checkIn.split(":").map(Number);
                const [hOut, mOut] = checkOut.split(":").map(Number);
                const minCheckIn = hIn * 60 + mIn;
                const minCheckOut = hOut * 60 + mOut;

                let valido = true;

                // Intervalos permitidos
                const manhaMin = 540,
                    manhaMax = 780; // 09:00 – 13:00
                const tardeMin = 840,
                    tardeMax = 1020; // 14:00 – 17:00

                let intervaloPermitido = (min) => false;
                if (periodoAtual === 'manha') {
                    intervaloPermitido = (min) => min >= manhaMin && min <= manhaMax;
                } else if (periodoAtual === 'tarde') {
                    intervaloPermitido = (min) => min >= tardeMin && min <= tardeMax;
                }

                if (!intervaloPermitido(minCheckIn)) {
                    checkInEl.classList.add("border-red-500");
                    erroCheckIn.classList.remove("hidden");
                    valido = false;
                } else {
                    checkInEl.classList.remove("border-red-500");
                    erroCheckIn.classList.add("hidden");
                }

                if (!intervaloPermitido(minCheckOut)) {
                    checkOutEl.classList.add("border-red-500");
                    erroCheckOut.classList.remove("hidden");
                    valido = false;
                } else {
                    checkOutEl.classList.remove("border-red-500");
                    erroCheckOut.classList.add("hidden");
                }

                // Check-out não pode ser antes do check-in
                if (minCheckOut <= minCheckIn) {
                    alert('O horário de Check-Out não pode ser anterior ou igual ao Check-In.');
                    valido = false;
                }

                return valido;
            }
        </script>
    @endsection
