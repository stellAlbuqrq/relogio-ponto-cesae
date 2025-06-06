@extends('layouts.user-layout.dashboard-layout')

@section('content')
    <form action="{{ route('alunos.guardar') }}" method="POST">
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Relógio Ponto</h2>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                    <label id= "hora" class="flex items-center space-x-2 px-3 py-2 text-gray-700">11:36</label>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Data</label>
                    <label id="data" class="flex items-center space-x-2 px-3 py-2 text-gray-700">26/05/2025</label>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Módulo</label>
                    <div class="flex items-center space-x-2 px-3 py-2">
                        <label for="modulo_hoje" class="text-gray-700">Algoritmia -</label>
                        <label for="formador_hoje" class="text-gray-700">Sara</label>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Comentários</label>
                    <textarea id="message" name="message" rows="4" placeholder="How can we help you?"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                    Enviar Picagem
                </button>
            </form>
        </div>
    </form>

    <script>

        //Função que mostra a hora/data no front-end (a hora/data a ser guardada na Tabela presença será a hora definida no Back-end)
        function mostrarHoraData() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString();
            const data = agora.toLocaleDateString();

            document.getElementById('hora').textContent = hora;
            document.getElementById('data').textContent = data;
        }


        mostrarHoraData();                           //Atualiza o método ao carregar a página

        setInterval(() => {                         //Atualiza a cada segundo que passa
            mostrarHoraData();
        }, 1000);


    </script>
@endsection
