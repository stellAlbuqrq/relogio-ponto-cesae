@extends('layouts.user-layout.admin-layout')

@vite(['resources/js/cronograma.js'])

@section('content')
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Cronograma de Aulas</h1>

    <div id="calendar" class="bg-white p-4 rounded shadow"></div>
@endsection

