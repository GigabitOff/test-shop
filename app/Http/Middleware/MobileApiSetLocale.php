<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;

class MobileApiSetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($locale = $request->query('locale')) {
            $exists = Language::query()
                ->where('status', true)
                ->where('lang', $locale)
                ->exists();

            if ($exists) {
                app()->setLocale($locale);
            }
        }

        return $next($request);
    }
}
