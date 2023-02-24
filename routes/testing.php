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
use App\Http\Controllers\Testing\PromotionsController;
use App\Http\Controllers\Testing\TestingController;
use App\Models\Language;
use Illuminate\Support\Arr;
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


if (app()->isProduction()){
    return;
}

Route::group(['middleware' => 'isAdmin'], function () {

    Route::get('/', [TestingController::class, 'index'])->name('testing.index');

    Route::get('/promotions/deactivate', [PromotionsController::class, 'deactivate'])
        ->name('testing.promotions.deactivate');

});
