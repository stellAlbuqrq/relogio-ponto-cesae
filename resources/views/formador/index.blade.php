@extends('layouts.user-layout.formador-layout')

@section('content')
    <div class="max-w-md mx-auto p-8 bg-white rounded-xl shadow-lg space-y-6">
    <h2 class="text-3xl font-bold text-gray-800 text-center">Relógio de Ponto</h2>

    <form action="{{ route('formador.pin') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Hora</label>
            <div id="hora" class="bg-gray-100 rounded-md px-4 py-2 text-gray-800"></div>
        </div>

        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Data</label>
            <div id="data" class="bg-gray-100 rounded-md px-4 py-2 text-gray-800"></div>
        </div>

        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Formador</label>
            <div class="bg-gray-100 rounded-md px-4 py-2 text-gray-800">
                {{ $cronograma->formador->nome }}
            </div>
        </div>

        <div>
            <label class="block text-gray-600 text-sm font-medium mb-1">Aula</label>
            <div class="bg-gray-100 rounded-md px-4 py-2 text-gray-800">
                {{ $cronograma->modulo->nome }}
            </div>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                Disparar PIN
            </button>
        </div>
    </form>
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
