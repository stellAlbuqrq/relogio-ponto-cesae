<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presenca;

class AdminPresencaController extends Controller
{
    // Admin apenas visualiza as presenças 
    public function index()
    {
        $presencas = Presenca::with(['aluno', 'cronograma'])->orderByDesc('created_at')->get();
        return view('admin.presencas.index', compact('presencas'));
    }
}
