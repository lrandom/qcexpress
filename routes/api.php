<?php

use App\GeneralSettings;

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'stuffs'], function () {
    Route::post('/change_quantity', 'Api\StuffsController@change_quantity');
    Route::post('/change_price', 'Api\StuffsController@change_price');
    Route::post('/change_status', 'Api\StuffsController@change_status');
    Route::post('/note', 'Api\StuffsController@note');
    Route::post('/change_link', 'Api\StuffsController@change_link');
});


Route::group(['prefix' => 'orders'], function () {
    Route::post('/change_fee_inland_transport', 'Api\OrdersController@change_fee_inland_transport');
    Route::post('/change_status', 'Api\OrdersController@change_status');
    Route::post('/change_exchange_rate', 'Api\OrdersController@change_exchange_rate');
    Route::post('/change_lading', 'Api\OrdersController@change_lading');
    Route::post('/change_wood_package', 'Api\OrdersController@change_wood_package');
    Route::post('/change_code_order_cn', 'Api\OrdersController@change_code_order_cn');
    Route::post('/change_buy_account', 'Api\OrdersController@change_buy_account');
    Route::post('/change_note_admin', 'Api\OrdersController@change_note_admin');
    Route::post('/change_price', 'Api\stuffsController@change_price');
    Route::post('/send_comment', 'Api\OrdersController@send_comment');
    Route::post('/upload', 'Api\OrdersController@upload');
});

Route::group(['prefix' => 'users'], function () {
    Route::post('get_cities/{id}', 'Api\UsersController@get_cities');
    Route::post('get_address/{id}', 'Api\UsersController@get_address');
});

Route::group([
    'middleware' => ['cors']
], function () {
    Route::get('/exchange_rate', function () {
        $general = GeneralSettings::first();
        return response()->json(['rate' => $general->exchange_rate_cn], 200);
    });
    Route::post('/save_cart', 'Api\CartsController@save');
});