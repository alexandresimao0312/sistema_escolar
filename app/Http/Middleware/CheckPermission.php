<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   

        public function handle($request, Closure $next, $permission)
    {
        if (auth()->check() && auth()->user()->hasPermission($permission)) {
            return $next($request);
        }

        abort(403, 'Você não tem permissão para acessar esta funcionalidade.');
    }

}
