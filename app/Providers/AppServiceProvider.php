<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\UserNotification;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\UserNotificationObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Вывод SQL запросов.
//        DB::listen(function($query){
//            logger($query->sql, $query->bindings);
//        });

        /**Users upload lang files */
        $this->loadTranslationsFrom(storage_path('app/public') . '/lang/', 'custom');

        $this->app->singleton(\App\Services\OrdersService::class, \App\Services\OrdersService::class);
        $this->app->singleton(\App\Services\BonusService::class, \App\Services\BonusService::class);
        $this->app->singleton(\App\Services\CashbackService::class, \App\Services\CashbackService::class);
        $this->app->singleton(\App\Services\UploadImagesService::class, \App\Services\UploadImagesService::class);
        $this->app->singleton(\App\Services\DocumentsService::class, \App\Services\DocumentsService::class);
        $this->app->singleton(\App\Services\UsersService::class, \App\Services\UsersService::class);
        $this->app->singleton(\App\Services\ProductPriceService::class, \App\Services\ProductPriceService::class);

        $this->assignMorphModels();
        $this->addBuilderMacro();

        // Дефолтная локаль для Faker
        $this->app->singleton(\Faker\Generator::class, fn() => \Faker\Factory::create('uk_UA'));

        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        UserNotification::observe(UserNotificationObserver::class);
    }

    protected function assignMorphModels()
    {
        Relation::enforceMorphMap([
            'counterparty' => 'App\Models\Counterparty',
            'user' => 'App\Models\User',
            'contract' => 'App\Models\Contract',
            'cart' => 'App\Models\Cart',
        ]);
    }

    protected function addBuilderMacro()
    {
        \Illuminate\Database\Query\Builder::macro('toRawSql', function (): string {
            /* @var $this \Illuminate\Database\Query\Builder */
            return array_reduce($this->getBindings(), function ($sql, $binding) {
                return preg_replace('/\?/', is_numeric($binding) ? $binding : "'" . $binding . "'", $sql, 1);
            }, $this->toSql());
        });

        \Illuminate\Database\Eloquent\Builder::macro('toRawSql', function(): string {
            /* @var $this \Illuminate\Database\Eloquent\Builder */
            return ($this->getQuery()->toRawSql());
        });

        \Illuminate\Database\Query\Builder::macro('whereInRaw', function (string $field, string $sub) {
            /* @var $this \Illuminate\Database\Query\Builder */
            return $this->whereIn($field, [DB::Raw($sub)]);
        });

        \Illuminate\Database\Query\Builder::macro('orWhereInRaw', function (string $field, string $sub) {
            /* @var $this \Illuminate\Database\Query\Builder */
            return $this->orWhereIn($field, [DB::Raw($sub)]);
        });

        \Illuminate\Database\Eloquent\Builder::macro('whereInRaw', function(string $field, string $sub){
            /* @var $this \Illuminate\Database\Eloquent\Builder */
            return $this->whereIn($field, [DB::Raw($sub)]);
        });

        \Illuminate\Database\Eloquent\Builder::macro('orWhereInRaw', function(string $field, string $sub){
            /* @var $this \Illuminate\Database\Eloquent\Builder */
            return $this->orWhereIn($field, [DB::Raw($sub)]);
        });
    }
}
