<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ExportController;
use App\Http\Controllers\Api\V1\ImportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('getCustomers', [ExportController::class, 'getCustomers']);
    Route::get('getCounterparties', [ExportController::class, 'getCounterparties']);
    Route::get('getOrdersRegistered', [ExportController::class, 'getOrdersRegistered']);
    Route::get('getFastOrders', [ExportController::class, 'getFastOrders']);
    Route::get('getYourTechnique', [ExportController::class, 'getYourTechnique']);
    Route::get('getDocs', [ExportController::class, 'getDocs']);
    Route::get('getDeliveryAddresses', [ExportController::class, 'getDeliveryAddresses']);
    Route::get('getProductsReserve', [ExportController::class, 'getProductsReserve']);
    Route::get('getChatMessage', [ExportController::class, 'getChatMessage']);


    Route::post('setAttributes', [ImportController::class, 'setAttributes']);
    Route::post('setBrands', [ImportController::class, 'setBrands']);
    Route::post('setCustomers', [ImportController::class, 'setCustomers']);
    Route::post('setCounterparties', [ImportController::class, 'setCounterparties']);
//    Route::post('setCounterpartyRewards', [ImportController::class, 'setCounterpartyRewards']);
    Route::post('setContracts', [ImportController::class, 'setContracts']);
    Route::post('setManagers', [ImportController::class, 'setManagers']);
    Route::post('setDrivers', [ImportController::class, 'setDrivers']);
    Route::post('setOrdersRegistered', [ImportController::class, 'setOrdersRegistered']);
    Route::post('setStatusesList', [ImportController::class, 'setStatusesList']);
    Route::post('setOrdersStatuses', [ImportController::class, 'setOrdersStatuses']);
    Route::post('setOrderTtn', [ImportController::class, 'setOrderTtn']);
    Route::post('setInvoice', [ImportController::class, 'setInvoice']);
    Route::post('setCategories', [ImportController::class, 'setCategories']);
    Route::post('setProductGroups', [ImportController::class, 'setProductGroups']);
    Route::post('setProductsPrice', [ImportController::class, 'setProductsPrice']);
    Route::post('setProductsStock', [ImportController::class, 'setProductsStock']);
    Route::post('setProductsVariations', [ImportController::class, 'setProductsVariations']);

    Route::post('setProductPrice', [ImportController::class, 'setProductPrice']);
    Route::post('setUsersDiscounts', [ImportController::class, 'setUsersDiscounts']);

    Route::post('setPersonalOffers', [ImportController::class, 'setPersonalOffers']);
    Route::post('setCustomerPersonalOffers', [ImportController::class, 'setCustomerPersonalOffers']);
    Route::post('setProducts', [ImportController::class, 'setProducts']);
    Route::post('setCounterpartyDebts', [ImportController::class, 'setCounterpartyDebts']);
    Route::post('setOrderDebts', [ImportController::class, 'setOrderDebts']);
    Route::post('setDebts', [ImportController::class, 'setDebts']);
    Route::post('setDocs', [ImportController::class, 'setDocs']);
    Route::post('setDocsStatuses', [ImportController::class, 'setDocsStatuses']);
    Route::post('setDeliveryAddresses', [ImportController::class, 'setDeliveryAddresses']);
    Route::post('setDeliveryTypes', [ImportController::class, 'setDeliveryTypes']);
    Route::post('setStorages', [ImportController::class, 'setStorages']);

    Route::post('setTransferred', [ImportController::class, 'setTransferred']);
    Route::post('setUsersChat', [ImportController::class, 'setUsersChat']);
});
