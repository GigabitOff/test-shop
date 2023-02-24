<?php

use App\Http\Controllers\Api\Mobile\V1\CounterpartyExportController;
use App\Http\Controllers\Api\Mobile\V1\UnauthorizedController;
//use App\Http\Controllers\Api\Mobile\V1\ExportController;
//use App\Http\Controllers\Api\Mobile\V1\ImportController;
use App\Http\Controllers\Api\Mobile\V1\UserExportController;
use App\Http\Controllers\Api\Mobile\V1\UserImportController;
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

Route::post('/login', [UnauthorizedController::class, 'login']);
Route::get('getLocales', [UnauthorizedController::class, 'getLocales']);
Route::post('setPasswordRecoverySendCode', [UnauthorizedController::class, 'setPasswordRecoverySendCode']);
Route::post('setPasswordRecoveryConfirmCode', [UnauthorizedController::class, 'setPasswordRecoveryConfirmCode']);
Route::get('searchCities', [UnauthorizedController::class, 'searchCities']);
Route::post('register', [UnauthorizedController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('getUserData', [UserExportController::class, 'getUserData']);
    Route::post('setUserData', [UserImportController::class, 'setUserData']);
    Route::post('setUserPassword', [UserImportController::class, 'setUserPassword']);
    Route::get('getUserPaymentTypesAvailable', [UserExportController::class, 'getUserPaymentTypesAvailable']);

    Route::get('getCounterparties', [CounterpartyExportController::class, 'getCounterparties']);
    Route::get('getContracts', [CounterpartyExportController::class, 'getContracts']);
//    Route::get('getFastOrders', [ExportController::class, 'getFastOrders']);
//    Route::get('getYourTechnique', [ExportController::class, 'getYourTechnique']);
//    Route::get('getDocs', [ExportController::class, 'getDocs']);
//    Route::get('getDeliveryAddresses', [ExportController::class, 'getDeliveryAddresses']);
//
//    Route::post('setAttributes', [ImportController::class, 'setAttributes']);
//    Route::post('setBrands', [ImportController::class, 'setBrands']);
//    Route::post('setCustomers', [ImportController::class, 'setCustomers']);
//    Route::post('setCounterparties', [ImportController::class, 'setCounterparties']);
//    Route::post('setCounterpartyRewards', [ImportController::class, 'setCounterpartyRewards']);
//    Route::post('setContracts', [ImportController::class, 'setContracts']);
//    Route::post('setManagers', [ImportController::class, 'setManagers']);
//    Route::post('setDrivers', [ImportController::class, 'setDrivers']);
//    Route::post('setOrdersRegistered', [ImportController::class, 'setOrdersRegistered']);
//    Route::post('setStatusesList', [ImportController::class, 'setStatusesList']);
//    Route::post('setOrdersStatuses', [ImportController::class, 'setOrdersStatuses']);
//    Route::post('setOrderTtn', [ImportController::class, 'setOrderTtn']);
//    Route::post('setInvoice', [ImportController::class, 'setInvoice']);
//    Route::post('setCategories', [ImportController::class, 'setCategories']);
//    Route::post('setProductGroups', [ImportController::class, 'setProductGroups']);
//    Route::post('setProductsPrice', [ImportController::class, 'setProductsPrice']);
//    Route::post('setPriceTypes', [ImportController::class, 'setPriceTypes']);
//    Route::post('setCustomersPriceType', [ImportController::class, 'setCustomersPriceType']);
//    Route::post('setCounterpartyProductPrice', [ImportController::class, 'setCounterpartyProductPrice']);
//    Route::post('setPersonalOffers', [ImportController::class, 'setPersonalOffers']);
//    Route::post('setCustomerPersonalOffers', [ImportController::class, 'setCustomerPersonalOffers']);
//    Route::post('setProducts', [ImportController::class, 'setProducts']);
//    Route::post('setContractDebts', [ImportController::class, 'setContractDebts']);
//    Route::post('setOrderDebts', [ImportController::class, 'setOrderDebts']);
//    Route::post('setDebts', [ImportController::class, 'setDebts']);
//    Route::post('setDocs', [ImportController::class, 'setDocs']);
//    Route::post('setDocsStatuses', [ImportController::class, 'setDocsStatuses']);
//    Route::post('setDeliveryAddresses', [ImportController::class, 'setDeliveryAddresses']);
//    Route::post('setDeliveryTypes', [ImportController::class, 'setDeliveryTypes']);
//    Route::post('setStorages', [ImportController::class, 'setStorages']);
//
//    Route::post('setTransferred', [ImportController::class, 'setTransferred']);
});
