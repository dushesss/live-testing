<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        \Log::info('Запрос дошёл до middleware', [
            'uri' => $request->getRequestUri(),
            'method' => $request->getMethod()
        ]);

        return $next($request);
    }

}
