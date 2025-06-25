@extends('layouts.user-layout.aluno-layout')

@section('content')
    <form action="{{ route('aluno.checkout') }}" method="POST">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold text-center">Check Out</h2>

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

            {{-- Botão --}}
            <button type="submit" name="acao" value="check_out"
                class="w-full bg-red-500 text-white font-semibold px-4 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring">
                Check‑out
            </button>

            {{-- Mensagem de erro --}}
            @if (session('mensagem'))
                <div class="flex items-start space-x-3 bg-red-100 border border-red-200 text-red-800 rounded p-4">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.72-1.36 3.485 0l5.518 9.815c.75 1.333-.213 3.086-1.742 3.086H4.48c-1.53 0-2.492-1.753-1.742-3.086L8.257 3.1zM11 13a1 1 0 10-2 0 1 1 0 002 0zm-1-8a1 1 0 00-.894.553l-.5 1a1 1 0 001.788.894l.5-1A1 1 0 0010 5z" />
                    </svg>
                    <div class="flex-1 text-sm">
                        {{ session('mensagem') }}
                    </div>
                    <button type="button" onclick="this.parentElement.remove()"
                        class="text-red-500 hover:text-red-700 focus:outline-none">
                        &times;
                    </button>
                </div>
            @endif
        </div>
    </form>

    <script>
        function mostrarHoraData() {
            const agora = new Date();
            const hora = agora.toLocaleTimeString();
            const data = agora.toLocaleDateString();

            document.getElementById('hora').textContent = hora;
            document.getElementById('data').textContent = data;
        }

        mostrarHoraData();

        setInterval(() => {
            mostrarHoraData();
        }, 1000);
    </script>
@endsection
