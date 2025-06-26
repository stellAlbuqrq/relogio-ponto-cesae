@extends('layouts.paginaAluno')

@section('content')
    <form action="{{ route('aluno.checkin') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="max-w-md mx-auto p-8 bg-white rounded-md shadow-md space-y-6">
            <h2 class="text-2xl font-semibold text-center">Justificar faltas</h2>

            {{-- Data --}}
            <div>
                <label for="data" class="block text-gray-700 text-sm font-bold mb-1">Selecione a data:</label>
                <input id="data" name="data" type="date"
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
