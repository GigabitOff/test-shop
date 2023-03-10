<?php

use App\Http\Controllers\Admin\CharacteristicsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminShopCityController;
use App\Http\Controllers\Admin\AdminActionController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminCatalogServiceController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminCatalogProductImportController;
use App\Http\Controllers\Admin\AdminChatsController;
use App\Http\Controllers\Admin\Contuct\AdminContuctController;
use App\Http\Controllers\Admin\AdminShopController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCounterpartyController;
use App\Http\Controllers\Admin\LocalizationController;
use App\Http\Controllers\Admin\Catalog\AdminCatalogProductController;
use App\Http\Controllers\Admin\Catalog\AdminCatalogFilterController;
use App\Http\Controllers\Admin\Catalog\AdminCatalogCategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminVacanciesController;
use App\Http\Controllers\Admin\Bonus\AdminBonusBonusController;
use App\Http\Controllers\Admin\Bonus\AdminBonusCashbackController;
use App\Http\Controllers\Admin\Bonus\AdminBonusDiscountController;
use App\Http\Controllers\Admin\Bonus\AdminBonusPersonalController;
use App\Http\Controllers\Admin\Bonus\AdminBonusMarketingController;

//dd(App::currentLocale());


Route::get('/login', [AdminController::class, 'login'])->name('login');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout_get');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/instructions', [AdminController::class, 'instructions'])->name('instructions');

    Route::get('langchange/{lang}', [LocalizationController::class, "lang_change"])->name('LangChange');

    Route::get('/', [AdminController::class, 'index'])->name('index');

    /** Робота із сторінками */
    Route::get('/pages/main', [AdminPageController::class, 'main'])->name('pages.main');


    /** Про нас сторінка */
    Route::get('/pages/about', [AdminPageController::class, 'about'])->name('pages.about');

    /** Доставка і оплата сторінка */
    Route::get('/pages/delivery-payment', [AdminPageController::class, 'delivery_payment'])->name('pages.delivery-payment');

    Route::get('/pages/create', [AdminPageController::class, 'create'])->name('pages.create');
    Route::resource('/pages', AdminPageController::class)
        ->only(['index', 'show', 'edit'])
        ->names('pages');

    /** Робота із акціями */
    Route::get('/actions/create', [AdminActionController::class, 'create'])->name('actions.create');
    Route::resource('/actions', AdminActionController::class)
        ->only(['index', 'show', 'edit'])
        ->names('actions');

    /** Робота із Новинами */
    Route::get('/news/create', [AdminNewsController::class, 'create'])->name('news.create');
    Route::resource('/news', AdminNewsController::class)
        ->only(['index', 'show', 'edit'])
        ->names('news');
    /** END Робота із акціями */

    /** Робота із опціями - Атрибути */
    //Route::get('/options/create', [AdminOptionController::class, 'create'])->name('options.create');
    //Route::resource('/options', AdminOptionController::class)
    //    ->only(['index', 'show', 'edit'])
    //    ->names('options');
    /** END Робота із опціями - Атрибути */

    /** Робота із банерами */
    Route::get('/banners/create', [AdminBannerController::class, 'create'])->name('banners.create');
    Route::resource('/banners', AdminBannerController::class)
        ->only(['index', 'show', 'edit'])
        ->names('banners');
    /** END Робота із банерами */

    /** Робота із брендами */
    Route::get('/brands/create', [AdminBrandController::class, 'create'])->name('brands.create');
    Route::resource('/brands', AdminBrandController::class)
        ->only(['index', 'show', 'edit'])
        ->names('brands');

    /** Робота із повідомленнями */
    //Route::get('/messages/create', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::resource('/messages', AdminMessageController::class)
        ->only(['index'])
        ->names('messages');

    /** Робота із Вакансіями */
    //Route::get('/jobs/create', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::resource('/jobs', AdminJobController::class)
        ->only(['index'])
        ->names('jobs');

    Route::get('/vacancies/create', [AdminVacanciesController::class, 'create'])->name('vacancies.create');
    Route::resource('/vacancies', AdminVacanciesController::class)
        ->only(['index', 'show', 'edit'])
        ->names('vacancies');

    /** Робота із Відгуками */
    Route::get('/reviews/create', [AdminReviewController::class, 'create'])->name('reviews.create');
    Route::resource('/reviews', AdminReviewController::class)
        ->only(['index', 'show', 'edit'])
        ->names('reviews');


    /** Робота із Контактами */
    Route::get('/contucts/create', [AdminContuctController::class, 'create'])->name('contucts.create');

    Route::resource('/contucts', AdminContuctController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('contucts');

    /** Робота із Магазинами */
    Route::get('/shop/create', [AdminShopController::class, 'create'])->name('shops.create');

    Route::resource('/shops', AdminShopController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('shops');

    Route::get('/shop_city/create', [AdminShopCityController::class, 'create'])->name('shop_cities.create');

    Route::resource('/shop_city', AdminShopCityController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('shop_cities');

    /** Робота із користувачами */
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    Route::resource('users', UserController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('users');

    /** Робота із контрагентами */
    Route::get('counterparties/create', [AdminCounterpartyController::class, 'create'])->name('counterparties.create');

    Route::resource('counterparties', AdminCounterpartyController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('counterparties');

    /** Settings */
    /** Робота із Користувачми адмін */
    Route::get('settings/create', [SettingsController::class, 'create'])->name('settings.create');

    Route::resource('settings', SettingsController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('settings');

    /** Робота з продуктами */

    /** Робота із імпортом */
    Route::get('/product-import/create', [AdminCatalogProductImportController::class, 'create'])->name('product-imports.create');
    Route::resource('/product-imports', AdminCatalogProductImportController::class)
        ->only(['index', 'edit'])
        ->parameters(['product-imports' => 'import'])
        ->names('product-imports');

    /** Внешние сервисы */
    Route::resource('services', ServicesController::class)
        ->only(['index', 'create', 'edit'])
        ->names('services');


    /** Характеристики */
    Route::resource('characteristics', CharacteristicsController::class)
        ->only(['index', 'create', 'edit'])
        ->names('characteristics');


    Route::group(['prefix' => 'catalog'], function () {

        /**Работа с товарами каталога */
        Route::resource('/product', AdminCatalogProductController::class)
            ->only(['index', 'edit', 'create'])
            ->names('product');

        Route::get('/filters/create', [AdminCatalogFilterController::class, 'create'])->name('filters.create');

        /** Робота із послугами */
//        Route::get('/services/create', [AdminCatalogServiceController::class, 'create'])->name('services.create');
        Route::resource('/services', AdminCatalogServiceController::class)
        ->only(['index', 'create', 'edit'])
        ->names('catalog.services');

        Route::get('/filters/basic-attributes', [AdminCatalogFilterController::class, 'basic_attributes'])->name('filters.basic_attributes');

        Route::get('/filters/additional-attributes', [AdminCatalogFilterController::class, 'additional_attributes'])->name('filters.additional_attributes');
        Route::get('/filters/seo', [AdminCatalogFilterController::class, 'seo_filters'])->name('filters.seo_filters');

        Route::resource('/filters', AdminCatalogFilterController::class)
            ->only(['index', 'edit'])
            ->names('filters');

        /**Работа с категориями каталога */
        Route::get('/category/create', [AdminCatalogCategoryController::class, 'create'])->name('category.create');

        Route::resource('/category', AdminCatalogCategoryController::class)
            ->only(['index', 'edit', 'show'])
            ->names('category');
    });

    Route::group(['prefix' => 'bonus'], function () {

        /**Работа с Скидки бонуса */
        Route::get('/discount/create', [AdminBonusDiscountController::class, 'create'])->name('bonus.discount.create');

        Route::resource('/discount', AdminBonusDiscountController::class)
            ->only(['index', 'edit', 'show'])
            ->names('bonus.discount');

        /**Работа с Кешбэк бонуса */
        Route::get('/cashback/create', [AdminBonusCashbackController::class, 'create'])->name('bonus.cashback.create');

        Route::resource('/cashback', AdminBonusCashbackController::class)
            ->only(['index', 'edit', 'show'])
            ->names('bonus.cashback');


        /**Работа с Кешбэк бонуса */
        Route::get('/personal/create', [AdminBonusPersonalController::class, 'create'])->name('bonus.personal.create');

        Route::resource('/personal', AdminBonusPersonalController::class)
            ->only(['index', 'edit', 'show'])
            ->names('bonus.personal');

        /**Работа с Кешбэк бонуса */
        Route::get('/marketing/create', [AdminBonusMarketingController::class, 'create'])->name('bonus.marketing.create');

        Route::resource('/marketing', AdminBonusMarketingController::class)
            ->only(['index', 'edit', 'show'])
            ->names('bonus.marketing');

        /**Работа с БОнус бонуса */
        Route::get('/bonus/create', [AdminBonusBonusController::class, 'create'])->name('bonus.bonus.create');

        Route::resource('/bonus', AdminBonusBonusController::class)
            ->only(['index', 'edit', 'show'])
            ->names('bonus');
    });


    Route::get('/chats', [AdminChatsController::class, 'index'])->name('chats.index');
    Route::get('/chats/{chat}', [AdminChatsController::class, 'show'])->name('chats.show');

    /** Роути для Меню */
    Route::get('/menu/create', [AdminMenuController::class, 'create'])->name('menu.create');
    Route::resource('/menu', AdminMenuController::class)
        ->only(['index', 'show', 'edit', 'destroy'])
        ->names('menu');
    /**End Роути для Меню */

    /** Робота із замовленнями */
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('orders.create');
    Route::resource('/orders', AdminOrderController::class)
        ->only(['index', 'show', 'edit'])
        ->names('orders');

    // vendor/ckfinder/ckfinder-laravel-package/src/routes.php
});
