@extends('layouts.user-layout.admin-layout')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Usuários</h3>
            <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Cursos</h3>
            <p class="text-2xl font-bold">{{ \App\Models\Curso::count() }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-600">Presenças</h3>
            <p class="text-2xl font-bold">{{ \App\Models\Presenca::count() }}</p>
        </div>
    </div>
@endsection
