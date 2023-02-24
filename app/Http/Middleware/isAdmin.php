<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    public function handle($request, Closure $next)
    {
        session()->put('lang', app()->currentLocale());

        if (Auth::guard('admin')->check() and Auth::guard('admin')->user()->isSiteAdmin) {
            return $next($request);
        } else {
            Auth::guard('admin')->logout();

            //session()->invalidate();

            //session()->regenerateToken();

            return redirect()->route('admin.login');

        }
    }

}
