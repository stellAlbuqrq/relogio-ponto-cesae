@extends('layouts.paginaAluno')

@section('content')
    <form action="{{ route('aluno.checkin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold text-center">Check In</h2>

            {{-- Hora --}}
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Hora</p>
                <div id="hora" class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700"></div>
            </div>

            {{-- Data --}}
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Data</p>
                <div id="data" class="w-full px-3 py-2 bg-gray-100 rounded text-gray-700"></div>
            </div>

            {{-- Módulo --}}
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Módulo</p>
                <div class="px-3 py-2 bg-gray-100 rounded text-gray-700">
                    {{ $cronograma->formador->nome }} – {{ $cronograma->modulo->nome }}
                </div>
            </div>

            {{-- Comentário --}}
            <div>
                <label for="comentario" class="block text-gray-700 text-sm font-bold mb-1">Comentário</label>
                <textarea id="comentario" name="comentario" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300 resize-y"
                    placeholder="Escreve aqui o teu comentário..."></textarea>
            </div>

             {{-- Anexo --}}
            <div>
                <label for="anexo" class="block text-gray-700 text-sm font-bold mb-1">Anexo (imagem ou PDF)</label>
                <input type="file" name="anexo" id="anexo"
                    accept="image/*,application/pdf"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            {{-- Botão --}}
            <button type="submit" name="acao" value="check_in"
                class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring">
                Check‑in
            </button>

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


        mostrarHoraData(); //Atualiza o método ao carregar a página

        setInterval(() => { //Atualiza a cada segundo que passa
            mostrarHoraData();
        }, 1000);
    </script>
@endsection
