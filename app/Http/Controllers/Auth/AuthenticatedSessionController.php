<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
$request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        if ($user->role === 'aluno') {
            return redirect()->route('aluno.dashboard');
        } elseif ($user->role === 'formador') {
            return redirect()->route('formador.dashboard');
            ############## INCLUIR DASHBOARD ADMIN
        } else {
            return redirect()->route('auth.login')->withErrors([
                'email' => 'O seu perfil não tem uma role válida.',
            ]);
        }

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
