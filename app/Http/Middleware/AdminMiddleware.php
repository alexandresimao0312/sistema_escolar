<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  
    public function handle($request, Closure $next)
{
   if (!auth()->guard('admin')->check()) {
        return redirect()->route('login.selecao')->with('errors', 'Acesso não autorizado.');
    }

    return $next($request);
}
}
