<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugBarQueryEnable
{
    /**
     * Активируем DebugBar по аргументу dben=1 строки запроса.
     * Также проверяет настройку в .env
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((bool)$request->get('dben', false) || config('debugbar.enabled', false)){
            \Debugbar::enable();
        } else {
            \Debugbar::disable();
        }
        return $next($request);
    }
}
