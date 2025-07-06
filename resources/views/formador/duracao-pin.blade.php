<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Número do PIN</title>

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

        {{-- Daisy UI --}}
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

@extends('layouts.paginaFormador')

@section('content')
    {{-- Formulário --}}
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex w-full max-w-[48rem] flex-col rounded-2xl bg-white border border-slate-200 shadow-sm">
            <div class="relative items-center flex flex-col justify-center text-white h-28 rounded-md bg-[#7426AA]">
                <h5 class="text-white text-4xl font-bold">
                    PIN
                </h5>
            </div>
            <div>
                <div class="block overflow-visible">

                    <div
                        class="relative block w-full overflow-hidden !overflow-x-hidden !overflow-y-visible bg-transparent">
                        <div role="tabpanel" data-value="card">

                            <form class="mt-3 flex flex-col" action="{{ route('formador.disparo-pin') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- Caso Pin já disparado, emite a mensagem de erro enviada pelo DisparoPinController --}}
                                @if (isset($mensagem))
                                    <div class="flex justify-center mb-3">
                                        <div role="alert" class="alert alert-error alert-soft border border-red-400 transition transform duration-500 ease-in-out animate-fadeIn
">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-lg">{{ $mensagem }}</span>
                                        </div>
                                    </div>
                                @endif


                                <div class="text-center mb-4 text-2xl">

                                    <!--Hora Ativação-->
                                    <div class="mb-6">
                                        <label class="block text-[#7426AA] font-bold">Hora de Ativação</label>
                                        <div id="hora" class="w-full px-3 text-[#232526]"></div>
                                    </div>

                                    <!--Duração PIN-->
                                    <div class="mb-6">
                                        <label class="block text-[#7426AA] font-bold">Duração do PIN</label>
                                        <div class="w-full px-3 text-[#232526]">
                                            {{ $horaExpiracao }}</div>
                                    </div>

                                    <!--PIN-->

                                        <div class="mb-3">
                                            <label class="block text-[#7426AA] font-bold">PIN</label>
                                            <div id="hora" class="w-full px-3 text-[#232526] font-bold text-2xl">
                                                {{ $pin }}</div>
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
