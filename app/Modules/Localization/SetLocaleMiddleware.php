<?php

namespace App\Modules\Localization;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $langPrefix = trim($request->route()->getPrefix(), '/');

        App::setLocale(LocalizationService::defaultLocale());

        $langPrefix = explode('/', $langPrefix)[0];
        if ($langPrefix && in_array($langPrefix, LocalizationService::getLocales())) {
            App::setLocale($langPrefix);

            $redirect = LocalizationService::checkRedirectToLocale($langPrefix, url()->current(), 301);
        }

        if(\Route::is('admin.*') AND session()->has('locale_admin')){
            App::setLocale(session()->get('locale_admin'));
        }

        return $redirect ?? $next($request);
    }
}
