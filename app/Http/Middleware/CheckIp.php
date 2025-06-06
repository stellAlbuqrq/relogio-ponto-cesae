<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Verifica o ip da máquina do usuário
        $ipAtual = $request->ip();

        //localhost
        dd($ipAtual);
        //$ipAtual = $request->header('X-Forwarded-For') ?? $request->ip();

        if (Auth::user() && Auth::user()->ip_address !== $ipAtual) {
            return redirect()->route('welcome')->with('error', 'Acesso não autorizado: IP não reconhecido.');
        }
      /*  if (Auth::user() && !$this->verificarIpUnico(Auth::user()->ip_address, $ipAtual)) {
            return redirect()->route('welcome')->with('error', 'Acesso não autorizado: IP não reconhecido.');
        }*/

        return $next($request);

        // ATENÇÃO!!!!!  AINDA É PRECISO DEFINIR SE VAI MESMO SER DIRECIONADA PARA WELCOME EM CASO DE ERRO E INCLUIR NA VIEW O ERRO COMENTADO AQUI:

        /*@if (session('error'))
        <div
            class="alert alert-success shadow-lg rounded-lg py-4 px-6 font-semibold text-red-800 bg-red-100 ring-1 ring-red-300">
                            {{ session('error') }}
        </div>
        @endif*/

    }

    private function verificarIpUnico($ip_address, $ipAtual)
    {
        if ($ip_address !== $ipAtual) {
            return true;
        }
    }
}
