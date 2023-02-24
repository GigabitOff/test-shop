<?php

namespace App\Providers;

use App\Modules\Localization\LocalizationService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    public const ADMIN_PREFIX = 'ad$min879';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            //For 1C server connections
            Route::prefix('api/v1')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api_v1.php'));

            // for mobile application connections
            Route::prefix('api/mobile/v1')
                ->middleware(['api', 'mobileApiSetLocale'])
                ->namespace($this->namespace)
                ->group(base_path('routes/api_mobile_v1.php'));

            Route::prefix('testing')
                ->middleware(['web'])
                ->namespace($this->namespace)
                ->group(base_path('routes/testing.php'));

            Route::middleware(['web'])
                ->namespace($this->namespace)
                ->prefix(self::ADMIN_PREFIX)
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->prefix(LocalizationService::getLocale())
                ->group(base_path('routes/web.php'));


        });
    }


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
