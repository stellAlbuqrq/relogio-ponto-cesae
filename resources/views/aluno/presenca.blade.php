@extends('layouts.user-layout.aluno-layout')

@section('content')
    <form action="{{ route('aluno.checkin') }}" method="POST">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Check In</h2>
            {{-- Erro mensagem caso o aluno tente picar antes do formador disparar o PIN --}}
            @if (isset($mensagem))
                <div class="text-red-600 font-medium text-sm mb-4">
                    {{ $mensagem }}
                </div>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                <label id= "hora" class="flex items-center space-x-2 px-3 py-2 text-gray-700"></label>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Data</label>
                <label id="data" class="flex items-center space-x-2 px-3 py-2 text-gray-700"></label>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Módulo</label>
                <div class="px-3 py-2">
                    <label class="text-gray-700">
                        {{ $cronograma->formador->nome }} - {{ $cronograma->modulo->nome }}
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Insira o PIN</label>
                <div class="px-3 py-2">
                    <input id="pinInserido" name="pinInserido" class="text-gray-700"></input>
                </div>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Comentários</label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="How can we help you?"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <button type="submit" name="acao" value="check_in"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Check-in
            </button>
        </div>
    </form>

    {{--
    <form action="{{ route('aluno.checkout') }}" method="POST">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md">
            <h2 class="text-2xl font-semibold mb-6">Check Out</h2>
            Erro mensagem caso o aluno tente picar antes do formador disparar o PIN
            @if (isset($mensagem))
                <div class="text-red-600 font-medium text-sm mb-4">
                    {{ $mensagem }}
                </div>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                <label id= "hora" class="flex items-center space-x-2 px-3 py-2 text-gray-700"></label>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Data</label>
                <label id="data" class="flex items-center space-x-2 px-3 py-2 text-gray-700"></label>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Módulo</label>
                <div class="px-3 py-2">
                    <label class="text-gray-700">
                        {{ $cronograma->formador->nome }} - {{ $cronograma->modulo->nome }}
                    </label>
                </div>

            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Comentários</label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="How can we help you?"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <button type="submit" name="acao" value="check_out"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                Check-out
            </button>
        </div>
    </form>
    --}}


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
