@extends('layouts.paginaAluno')

@section('content')
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
    <form action="{{ route('aluno.justificacoes-guardar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold text-center">Justificar faltas</h2>

            {{-- Data --}}
            <div>
                <label for="data" class="block text-gray-700 text-sm font-bold mb-1">Selecione a data:</label>
                <input id="data_justificada" name="data_justificada" type="date" required
                    class="w-full px-3 py-2 border border-gray-300 rounded bg-gray-100 text-gray-700 focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            {{-- Período --}}
            <div>
                <p class="block text-gray-700 text-sm font-bold mb-1">Selecione o período</p>
                <div class="flex justify-between gap-2">
                    <input type="radio" name="periodo" id="manha" value="manha" class="peer hidden"
                        {{ old('periodo', $justificacao->periodo ?? '') == 'manha' ? 'checked' : '' }} />
                    <label for="manha"
                        class="flex-1 text-center cursor-pointer px-4 py-2 rounded border border-gray-300 bg-gray-100 hover:bg-blue-100 peer-checked:bg-blue-500 peer-checked:text-white">
                        Manhã
                    </label>

                    <input type="radio" name="periodo" id="tarde" value="tarde" class="peer hidden"
                        {{ old('periodo', $justificacao->periodo ?? '') == 'tarde' ? 'checked' : '' }} />
                    <label for="tarde"
                        class="flex-1 text-center cursor-pointer px-4 py-2 rounded border border-gray-300 bg-gray-100 hover:bg-blue-100 peer-checked:bg-blue-500 peer-checked:text-white">
                        Tarde
                    </label>
                </div>
            </div>

            <p class="text-sm text-gray-500 mt-1">*Caso dia todo, crie duas justificações (manhã/tarde).</p>

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
                <input type="file" name="anexo" id="anexo" accept="image/*,application/pdf"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-300" />
            </div>

            {{-- Botão --}}
            <button type="submit" name="justificar" value="justificar"
                class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring">
                Enviar justificação
            </button>
        </div>
    </form>
@endsection
