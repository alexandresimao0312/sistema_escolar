<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;
use Illuminate\Support\Str;

class SetSessionCookieByGuard
{
    
    public function handle($request, Closure $next)
    {
        if ($guard = $request->route()?->getAction('guard')) {
            config(['session.cookie' => Str::slug(config('app.name'), '_') . "_{$guard}_session"]);
        }

        return $next($request);
    }
}
