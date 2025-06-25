@extends('layouts.user-layout.formador-layout')

@section('content')
    <div class="max-w-md mx-auto p-8 bg-white rounded-xl shadow-lg space-y-6">
        <h2 class="text-3xl font-bold text-gray-800 text-center">Relógio de Ponto</h2>
        {{-- Caso Pin já disparado, emite a mensagem de erro enviada pelo DisparoPinController --}}
        @if (isset($mensagem))
            <div class="text-red-600 font-medium text-sm mb-4">
                {{ $mensagem }}
            </div>
        @endif
        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Hora ativação:</label>
            <div id="hora" class="bg-gray-100 rounded-md px-4 py-2 text-gray-800"></div>
        </div>

        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">PIN</label>
            <div id="hora" class="bg-gray-100 rounded-md px-4 py-2 text-gray-800">{{ $pin }}</div>
        </div>

        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Duração do PIN:</label>
            <div class="bg-gray-100 rounded-md px-4 py-2 text-gray-800">{{ $horaExpiracao }}</div>
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
