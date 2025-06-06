<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    protected $roles;

    public function __construct($roles = [])
    {
        $this->roles = $roles;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

       // $user = Auth::user();

        //CheckRole é um middleware genérico, ou seja, o tipo de role será definido nas rotas
        if (in_array(Auth::user()->role, $this->roles)) {
            abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
        }


        return $next($request);
    }
}
