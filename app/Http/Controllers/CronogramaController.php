<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function mostrarCronograma(){

        return view('aluno.cronograma');
    }
}
