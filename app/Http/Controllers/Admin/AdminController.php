<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

     public function index()
    {
        return view('admin.dashboard'); // <- deve bater com o caminho da view
    }
}
