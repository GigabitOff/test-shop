<?php

use App\Http\Controllers\AuthProvidersController;
use App\Http\Controllers\Cart\ClientCartController;
use App\Http\Controllers\Catalog\CatalogController;
use App\Http\Controllers\Catalog\Product\CatalogProductController;
use App\Http\Controllers\Customer\ChatsController as CustomerChatsController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DocumentsController as CustomerDocumentsController;
use App\Http\Controllers\Customer\OrdersController as CustomerOrdersController;
use App\Http\Controllers\Customer\UsersController as CustomerUsersController;
use App\Http\Controllers\Jobs\JobsController;
use App\Http\Controllers\Brands\BrandsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Manager\ChatsController as ManagerChatsController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\DocumentsController as ManagerDocumentsController;
use App\Http\Controllers\Manager\OrdersController as ManagerOrdersController;
use App\Http\Controllers\Manager\UsersController as ManagerUsersController;
use App\Http\Controllers\Pages\PageAboutController;
use App\Http\Controllers\Pages\PageActionController;
use App\Http\Controllers\Pages\PageContactController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Pages\PageNewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Search\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/{any}', function () {
//     return response()->redirectTo('/swagger');
// })->where('any', '.*')->name('main');

// return;

Route::get('/', [MainController::class, 'index'])->name('main');
// logout закоментирован, т.к. выполняется модулем fortify
Route::get('/logout', [MainController::class, 'logout'])->name('logout');
Route::get('/locale/{locale}', [MainController::class, 'setLocale'])->name('setLocale');


/** Auth throw external providers */
Route::group(['prefix' => 'google'], function () {
    Route::get('/auth/login', [AuthProvidersController::class, 'googleAuthLogin'])->name('googleAuthLogin');
    Route::get('/auth/callback', [AuthProvidersController::class, 'googleAuthCallback'])->name('googleAuthCallback');;
});
Route::group(['prefix' => 'apple'], function () {
    Route::get('/auth/login', [AuthProvidersController::class, 'appleAuthLogin'])->name('appleAuthLogin');
    Route::post('/auth/callback', [AuthProvidersController::class, 'appleAuthCallback'])->name('appleAuthCallback');;
});
Route::group(['prefix' => 'diia'], function () {
    Route::get('/auth/login', [AuthProvidersController::class, 'diiaAuthLogin'])->name('diiaAuthLogin');
    Route::get('/auth/callback', [AuthProvidersController::class, 'diiaAuthCallback'])->name('diiaAuthCallback');;
});
Route::group(['prefix' => 'bankid'], function () {
    Route::get('/auth/login', [AuthProvidersController::class, 'bankidAuthLogin'])->name('bankidAuthLogin');
    Route::get('/auth/callback', [AuthProvidersController::class, 'bankidAuthCallback'])->name('bankidAuthCallback');;
});

/** Catalog routes */
Route::resource('/catalog', CatalogController::class)
    ->only(['index', 'show'])
    ->parameters(['catalog' => 'category',])
    ->names('catalog');

Route::resource('/products', CatalogProductController::class)
    ->only(['index', 'show'])
    ->names('products')
    ->middleware('productVisitCounter');

    /** Brand pages */
Route::resource('/brands', BrandsController::class)
    ->only(['index', 'show'])
    ->names('brands');


/** JOBS  */
Route::resource('/jobs', JobsController::class)
    ->only(['index', 'show'])
    ->names('jobs');

/** News  */
Route::resource('/news', PageNewsController::class)
    ->only(['index', 'show'])
    ->names('news');

/** Contacts */
Route::resource('/contacts', PageContactController::class)
    ->only(['index', 'show'])
    ->names('contacts');

/** About company */
Route::resource('/about', PageAboutController::class)
    ->only(['index'])
    ->names('about');

/**information processing**/
Route::get('/privacy-policy', [PageController::class, 'informationProcessing'])->name('privacy-policy');

/**information processing**/
Route::get('/site-terms', [PageController::class, 'siteTerms'])->name('site-terms');

/** Доставка і оплата */
Route::get('/delivery-payment', [PageController::class, 'delivery_payment'])->name('delivery-payment');
Route::get('/polityka-konfidenciynosti', [PageController::class, 'page_privacy_policy'])->name('polityka-konfidenciynosti');

/** Page services */
Route::get('/services', [PageController::class, 'services'])->name('services');

/** Promotion pages */
Route::resource('/actions', PageActionController::class)
    ->only(['index', 'show'])
    ->names('actions')
    ->middleware('actionVisitCounter');


/** Promotion pages */
Route::resource('/search', SearchController::class)
    ->only(['index', 'show'])
    ->names('search');

Route::get('/cart', [MainController::class, 'unregisteredCart'])->name('unregistered-cart');

Route::group(['prefix' => 'customer'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [CustomerController::class, 'toDashboard']);
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('/cart', [ClientCartController::class, 'cart'])->name('customer.cart');
        Route::get('/favorites', [CustomerController::class, 'favorites'])->name('customer.favorites');
        Route::get('/waiting', [CustomerController::class, 'waiting'])->name('customer.waiting');
        Route::get('/comparisons', [CustomerController::class, 'comparisons'])->name('customer.comparisons');
        Route::get('/debts', [CustomerController::class, 'debts'])->name('customer.debts');
        Route::get('/discounts', [CustomerController::class, 'discounts'])->name('customer.discounts');

        Route::get('/users', [CustomerUsersController::class, 'index'])->name('customer.users.index');
        Route::get('/users/{id}/edit', [CustomerUsersController::class, 'edit'])->name('customer.users.edit');
        Route::get('/users/relation', [CustomerUsersController::class, 'relation'])->name('customer.users.relation');

        Route::resource('/orders', CustomerOrdersController::class)
            ->only(['index', 'show', 'create', 'edit'])
            ->names('customer.orders');

        Route::get('/orders/{order}/reverse-invoice/create', [CustomerDocumentsController::class, 'createReverseInvoice'])->name(
            'customer.orders.reverse-invoice.create'
        );
        Route::get('/orders/{order}/complaint/create', [CustomerDocumentsController::class, 'createComplaint'])->name(
            'customer.orders.complaint.create'
        );
        Route::get('/documents', [CustomerDocumentsController::class, 'index'])->name('customer.documents.index');

        Route::get('/chats', [CustomerChatsController::class, 'index'])->name('customer.chats.index');
        Route::get('/chats/{chat}', [CustomerChatsController::class, 'show'])->name('customer.chats.show');

    });
});

Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/cart', [ManagerController::class, 'cart'])->name('manager.cart');
    Route::get('/debts', [ManagerController::class, 'debts'])->name('manager.debts');

    Route::get('/users', [ManagerUsersController::class, 'index'])->name('manager.users.index');
   // Route::get('/users/{id}', [ManagerUsersController::class, 'show'])->name('manager.users.show');
    Route::get('/users/relation', [ManagerUsersController::class, 'relation'])->name('manager.users.relation');

    Route::get('/documents', [ManagerDocumentsController::class, 'index'])->name('manager.documents.index');

    Route::resource('/orders', ManagerOrdersController::class)
        ->only(['index', 'show', 'create', 'edit'])
        ->names('manager.orders');
    Route::get('/orders/{order}/reverse-invoice/create', [ManagerDocumentsController::class, 'createReverseInvoice'])->name(
        'manager.orders.reverse-invoice.create'
    );
    Route::get('/orders/{order}/complaint/create', [ManagerDocumentsController::class, 'createComplaint'])->name(
        'manager.orders.complaint.create'
    );

    Route::get('/chats', [ManagerChatsController::class, 'index'])->name('manager.chats.index');
    Route::get('/chats/{chat}', [ManagerChatsController::class, 'show'])->name('manager.chats.show');

});

Route::group(['prefix' => 'payment'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/{order}/liqpay', [PaymentController::class, 'liqpay'])->name('payment.liqpay');
    });

    Route::post('/callback/liqpay', [PaymentController::class, 'callbackLiqpay'])->name('payment.callback.liqpay');
});

Route::get('/tester', function() {
    $res = '';

//    $o = \App\Models\Product::find(1);
//    $o->attributeValues()->sync(906);
//    $query = $o->replacements();
//    $res = [
//        $query->toSql(),
//        $query->getBindings(),
//        $query->toRawSql(),
//        $query->get(),
//    ];

//    $q = \App\Models\Product::query();
//    $res = $q->where('articul', 'like', '%'. '19198' . '%')->count();

    return response()->json($res);

});

Route::get('/fpi-creator', function() {
    $res = '';

    $res = \App\Models\ProductImport::create([
        'type'  => \App\Models\ProductImport::TYPE_XML,
//        'source_file' => 'https://powerplay.com.ua/yandex_market.xml?hash_tag=d8922cb3e9b587ad3a1f66f839f98a77&sales_notes=&product_ids=&label_ids=&exclude_fields=&html_description=1&yandex_cpa=&process_presence_sure=&export_lang=uk&languages=uk%2Cru&group_ids=38152639%2C38153303%2C38154404%2C38154549%2C38157715%2C38157952%2C38158726%2C38159202%2C38159256%2C38159383%2C97784997%2C98228191&nested_group_ids=38152639%2C38153303%2C38154404%2C38154549%2C38157715%2C38157952%2C38158726%2C38159383',
        'source_file' => 'imports/test.csv',

    ]);

    return response()->json($res);
});//->middleware('auth:sanctum');

Route::get('/testliqpay', function(){
//    $liqpay = app()->make('LiqPay');
//    $liqpay->pay(2.00);
    return \DenizTezcan\LiqPay\Facades\LiqPay::pay(1);
});

Route::get('/test-import', function(){
    $type = request()->get('type');

    if ('xml' === $type) {
        return Storage::disk('public')->download('imports/3-test.xml', null, ['Content-Disposition'=> 'inline']);
    }
    if ('csv' === $type) {
        return Storage::disk('public')->download('imports/test-utf8.csv', null, ['Content-Disposition'=> 'inline']);
    }
    if ('xls' === $type) {
        return Storage::disk('public')->download('imports/test.xls', null, ['Content-Disposition'=> 'inline']);
    }

    return 'unknown type.';
});

/** Brand pages */
Route::resource('/brands', BrandsController::class)
    ->only(['index', 'show'])
    ->names('brands');

Route::get('/{id}', [PageController::class, 'show'])->name('pages.show');

