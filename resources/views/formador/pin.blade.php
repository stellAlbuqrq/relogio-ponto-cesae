<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIN</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

</head>

@extends('layouts.paginaFormador')

@section('content')

    {{-- Formulário --}}
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="relative items-center flex flex-col justify-center text-white h-28 rounded-md bg-[#40155E]">
                <h5 class="text-white text-3xl font-bold">
                    Relógio de Ponto
                </h5>
            </div>
            <div class="p-6">
                <div class="block overflow-visible">

                    <div
                        class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">

                            <form class="mt-3 flex flex-col" action="{{ route('formador.disparo-pin') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="flex justify-center gap-20 text-center mb-4 text-2xl">

                                    <!--Data-->
                                    <div class="relative mb-6" data-twe-input-wrapper-init>
                                        <p class="block text-[#40155E] font-bold">Data</p>
                                        <div id="data" class="w-full px-3 text-[#232526]"></div>
                                    </div>

                                    <!--Horário-->
                                    <div class="relative mb-6" data-twe-input-wrapper-init>
                                        <p class="block text-[#40155E] font-bold">Horário</p>
                                        <div id="hora" class="w-full px-3 text-[#232526] font-semibold"></div>
                                    </div>
                                </div>

                                {{-- Formador --}}
                                <div class="mb-5 ml-5">
                                    <p class="block mb-1 text-lg text-[#40155E] font-bold">Formador(a)</p>
                                    <div class=" text-gray-700 font-semibold">
                                        {{ $cronograma->formador->nome }}
                                    </div>
                                </div>

                                {{-- Módulo --}}
                                <div class="mb-5 ml-5">
                                    <p class="block mb-2 text-lg text-[#40155E] font-bold">Módulo</p>
                                    <div class=" flex justify-center">
                                        <div
                                            class="px-4 py-2 w-fit bg-[#f0e1ff] rounded-lg text-center text-gray-700 font-semibold">
                                            {{ $cronograma->modulo->nome }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Botão --}}
                                <div class="relative items-center flex flex-col justify-center mb-2">
                                    <button type="submit" name="acao" value="check_in"
                                        class="w-fit bg-[#40155E] text-white font-semibold px-4 py-2 rounded-lg mt-5 hover:bg-[#36194b] focus:outline-none focus:ring">
                                        Disparar PIN
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //Função que mostra a hora/data no front-end (a hora/data a ser guardada na Tabela presença será a hora definida no Back-end)
        function mostrarHoraData() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString();
            const data = agora.toLocaleDateString();

            document.getElementById('hora').textContent = hora;
            document.getElementById('data').textContent = data;
        }


        mostrarHoraData(); //Atualiza o método ao carregar a página

        setInterval(() => { //Atualiza a cada segundo que passa
            mostrarHoraData();
        }, 1000);
    </script>
@endsection
