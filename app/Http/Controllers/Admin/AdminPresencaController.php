<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Presenca;

class AdminPresencaController extends Controller
{
    // Admin apenas visualiza as presenças

    public function index()
    {
        // Pega 10 presenças por página
        $presencas = Presenca::with(['aluno', 'cronograma.modulo'])->paginate(10);

        return view('admin.presencas.index', compact('presencas'));
    }


}
