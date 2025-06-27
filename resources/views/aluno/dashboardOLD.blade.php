@extends('layouts.user-layout.aluno-layout')

@section('content')
    <h1>HI JULIA, THIS IS ALUNO DASHBOARD PAGE!!</h1>

    {{-- Mensagem de sucesso de presença --}}
    @if (session('mensagem'))
        <div class="flex items-start space-x-3 bg-green-100 border border-green-200 text-green-800 rounded-lg p-4 shadow-sm">
            <svg class="w-6 h-6 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-7.364 7.364a1 1 0 01-1.414 0L3.293 9.414a1 1 0 011.414-1.414L9 12.293l6.293-6.293a1 1 0 011.414 0z" />
            </svg>
            <div class="flex-1 text-sm font-medium">
                {{ session('mensagem') }}
            </div>
            <button type="button" onclick="this.parentElement.remove()"
                class="text-green-500 hover:text-green-700 focus:outline-none text-lg font-bold leading-none">
                &times;
            </button>
        </div>
    @endif
@endsection
