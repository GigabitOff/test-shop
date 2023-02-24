<?php

namespace App\Modules\Localization;


use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\Lang;
use App\Models\Language;

class Localization
{
    protected array $locales = [];
    protected string $default_locale = '';

    public function __construct(Locales $translatable)
    {
        if (!app()->runningInConsole()) {
            $languages = Language::where('status', 1)->pluck('lang')->toArray();

            foreach ($languages as $language) {
                if (!in_array($language, $translatable->all())) {
                    $translatable->add($language);
                }
            }
        }

        $this->locales = $languages ?? $translatable->all();
    }

    /**
     * Локаль по умолчанию.
     * @return string
     */
    public function defaultLocale(): string
    {
        if (!$this->default_locale) {
            $locale = Language::where('status', 1)->orderBy('default', 'DESC')->take(1)->value('lang');

            if($locale){
                config(['app.fallback_locale' => $locale]);
            }
            //dd(config('translatable.fallback_locale'));
            $this->default_locale = $locale ?? config('app.fallback_locale');
        }

        return $this->default_locale;
    }

    /**
     * Список используемых локалей.
     * Используются только значения массива
     *
     * @return array
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    public function getLocale()
    {
        $locale = request()->segment(1, '');

        if ($locale && in_array($locale, $this->getLocales())) {
            return $locale;
            // если включить, то url с сегментом $this->defaultLocale() будет отдавать 404
            //            return ($locale === $this->defaultLocale() ? '' : $locale);
        }

        return '';
    }

    public function checkRedirectToLocale($locale, $url = '', $status = 302)
    {
        if ($locale === $this->defaultLocale()) {
            return $this->redirectToLocale($url ?: url()->previous(), $locale, $status);
        }

        return null;
    }

    public function setLocale($locale)
    {
        return $this->redirectToLocale(url()->previous(), $locale);
    }

    /**
     * Подставляет в url языковой сегмент.
     *
     * @url https://mydnic.be/post/how-to-build-an-efficient-and-seo-friendly-multilingual-architecture-for-your-laravel-application
     *
     * @param string $url
     * @param string $locale
     * @param int $status Redirect status code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToLocale($url, $locale, $status = 302)
    {
        // Store the URL on which the user was
        //$previous_url = url()->previous();

        // Transform it into a correct request instance
        $previous_request = app('request')->create($url);

        // Get Query Parameters if applicable
        $query = $previous_request->query();

        // In case the route name was translated
        $route_name = app('router')->getRoutes()->match($previous_request)->getName();

        // Store the segments of the last request as an array
        $segments = $previous_request->segments();

        // Check if the first segment matches a language code
        if (in_array($locale, $this->getLocales())) {
            // If it was indeed a translated route name
            if ($route_name && Lang::has('routes.' . $route_name, $locale)) {
                $new_url = $locale . '/' . trans('routes.' . $route_name, [], $locale);
                $qry_str = count($query) ? '?' . http_build_query($query) : '';

                return redirect()->to($new_url . $qry_str, $status);
            }

            // If first segment is a language segment
            if ($segments && in_array($segments[0], $this->getLocales())) {
                // Replace the first segment by the new language code
                // only for not default language
                $segments[0] = ($locale === $this->defaultLocale() ? '' : $locale);
            } else {
                if ($locale !== $this->defaultLocale()) {
                    array_unshift($segments, $locale);
                }
            }

            $new_url = implode('/', $segments);
            $qry_str = count($query) ? '?' . http_build_query($query) : '';

            return redirect()->to($new_url . $qry_str, $status);
        }

        return redirect()->back();
    }
}
