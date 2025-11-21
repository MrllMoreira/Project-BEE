<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSecretaria
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $unidadeId = request()->route('idUnidade');
        
        // Admin/Secreatria pode acessar tudo
        if ($user->role_id == 3 || $user->role_id == 1) {
            return $next($request);
        }else if ($user->unidade_id == $unidadeId){
            return $next($request);
        }else{
            abort(403, 'Acesso não autorizado.');
        }
        
    }
}
