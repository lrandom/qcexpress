<?php
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

// Route::get('/', function () {
//     return view('welcome');
// });

//use Illuminate\Routing\Route;



Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::get('profile', function () { })->middleware('verified');

Route::get('admin/login', 'Admin\UsersControllers@login');
Route::post('admin/login', 'Admin\UsersControllers@login');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', function () {
        return Redirect::to('admin/dashboard');
    });
    Route::get('register', 'Admin\UsersControllers@register');
    Route::post('register', 'Admin\UsersControllers@register');

    Route::get('dashboard', 'Admin\DashboardControllers@index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'Admin\UsersControllers@index');
        Route::get('add', 'Admin\UsersControllers@add');
        Route::post('add', 'Admin\UsersControllers@add');
        Route::get('edit/{id}', 'Admin\UsersControllers@edit');
        Route::post('edit/{id}', 'Admin\UsersControllers@edit');
        Route::get('active/{id}', 'Admin\UsersControllers@active');
        Route::get('deactive/{id}', 'Admin\UsersControllers@deactive');
        Route::get('delete/{id}', 'Admin\UsersControllers@delete');
        Route::get('profile', 'Admin\UsersControllers@profile');
        Route::post('profile', 'Admin\UsersControllers@profile');
        Route::get('change-password', 'Admin\UsersControllers@password');
        Route::post('change-password', 'Admin\UsersControllers@password');
        Route::get('logout', 'Admin\UsersControllers@logout');
    });

    Route::group(['prefix' => 'complaints'], function () {
        Route::get('', 'Admin\ComplaintsControllers@index');
        Route::get('detail/{id}', 'Admin\ComplaintsControllers@detail');
        Route::get('not_seen/{id}', 'Admin\ComplaintsControllers@not_seen');
        Route::get('pending/{id}', 'Admin\ComplaintsControllers@pending');
        Route::get('success/{id}', 'Admin\ComplaintsControllers@success');
        Route::get('faild/{id}', 'Admin\ComplaintsControllers@faild');
        Route::get('delete/{id}', 'Admin\ComplaintsControllers@delete');
    });

    Route::group(['prefix' => 'banks'], function () {
        Route::get('', 'Admin\BanksControllers@index');
        Route::get('add', 'Admin\BanksControllers@add');
        Route::post('add', 'Admin\BanksControllers@add');
        Route::get('edit/{id}', 'Admin\BanksControllers@edit');
        Route::post('edit/{id}', 'Admin\BanksControllers@edit');
        Route::get('active/{id}', 'Admin\BanksControllers@active');
        Route::get('deactive/{id}', 'Admin\BanksControllers@deactive');
        Route::get('delete/{id}', 'Admin\BanksControllers@delete');
    });

    Route::group(['prefix' => 'post_categories'], function () {
        Route::get('', 'Admin\PostCategoriesControllers@index');
        Route::get('add', 'Admin\PostCategoriesControllers@add');
        Route::post('add', 'Admin\PostCategoriesControllers@add');
        Route::get('edit/{id}', 'Admin\PostCategoriesControllers@edit');
        Route::post('edit/{id}', 'Admin\PostCategoriesControllers@edit');
        Route::get('active/{id}', 'Admin\PostCategoriesControllers@active');
        Route::get('deactive/{id}', 'Admin\PostCategoriesControllers@deactive');
        Route::get('delete/{id}', 'Admin\PostCategoriesControllers@delete');
    });

    Route::group(['prefix' => 'posts'], function () {
        Route::get('', 'Admin\PostsControllers@index');
        Route::get('add', 'Admin\PostsControllers@add');
        Route::post('add', 'Admin\PostsControllers@add');
        Route::get('edit/{id}', 'Admin\PostsControllers@edit');
        Route::post('edit/{id}', 'Admin\PostsControllers@edit');
        Route::get('active/{id}', 'Admin\PostsControllers@active');
        Route::get('deactive/{id}', 'Admin\PostsControllers@deactive');
        Route::get('delete/{id}', 'Admin\PostsControllers@delete');
    });

    Route::group(['prefix' => 'transport'], function () {
        Route::get('request_transport', 'Admin\TransportsControllers@request_transport');
        Route::get('wait_for_pay', 'Admin\TransportsControllers@wait_for_pay');
        Route::post('cancel', 'Admin\TransportsControllers@cancel_transport');
        //Route::get('bill_transport', 'Admin\TransportsControllers@bill_transport');
        //Route::get('bill_transport/{id}', 'Admin\TransportsControllers@bill_transport');
        Route::post('agree_ship', 'Admin\TransportsControllers@agree_ship');
        Route::get('received/{id}', 'Admin\TransportsControllers@received');
        Route::post('upload_img', 'Admin\TransportsControllers@upload_img');
        Route::get('list/{status}', 'Admin\TransportsControllers@index');
    });

    Route::group(['prefix' => 'statements'], function () {
        Route::get('', 'Admin\StatementsControllers@index');
        Route::get('pending/{id}', 'Admin\StatementsControllers@pending');
        Route::get('compelte/{id}', 'Admin\StatementsControllers@compelte');
        Route::get('delete/{id}', 'Admin\StatementsControllers@delete');
    });

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'Admin\SettingsControllers@general');
        Route::get('general', 'Admin\SettingsControllers@general');
        Route::post('general', 'Admin\SettingsControllers@postGeneral');
        Route::get('default-general', 'Admin\SettingsControllers@resetGeneral');
        Route::get('services', 'Admin\SettingsControllers@services');
        Route::post('services', 'Admin\SettingsControllers@postServices');
        Route::get('default-services', 'Admin\SettingsControllers@resetServices');
        Route::get('contacts', 'Admin\SettingsControllers@contacts');
        Route::post('contacts', 'Admin\SettingsControllers@postContacts');
        Route::get('default-contacts', 'Admin\SettingsControllers@resetContacts');
        Route::get('post-lists', 'Admin\SettingsControllers@postLists');
    });
    Route::get('orders/{id}', 'Admin\OrdersControllers@index');
    Route::post('orders/upload_img', 'Admin\OrdersControllers@upload_img');
    Route::post('orders/cancel_order', 'Admin\OrdersControllers@cancel_order');
    Route::get('orders/delete/{id}', 'Admin\OrdersControllers@delete');
});




// Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
// 	Route::get('/', function() {
// 		return view('auth.login');
// 	});
// });



Route::get('users/logout', 'User\UsersControllers@logout');
Route::group(['prefix' => 'users', 'middleware' => ['auth', 'verified']], function () {
    Route::get('account', 'User\UsersControllers@account');
    Route::post('account', 'User\UsersControllers@account');
    Route::post('add_address', 'User\UsersControllers@add_address');
    Route::post('edit_address', 'User\UsersControllers@edit_address');
    Route::get('default_address/{id}', 'User\UsersControllers@default_address');
    Route::get('delete_address/{id}', 'User\UsersControllers@delete_address');
    Route::get('password', 'User\UsersControllers@password');
    Route::post('password', 'User\UsersControllers@password');

    Route::get('orders/{id}', 'User\OrdersControllers@index');
    Route::get('orders/detail/{id}', 'User\OrdersControllers@detail');
    Route::post('orders/payment', 'User\OrdersControllers@payment');
    Route::post('orders/upload_img', 'User\OrdersControllers@upload_img');

    Route::get('success', 'User\CartsController@success');

    Route::get('finance/statements', 'User\StatementsControllers@index');
    Route::get('finance/deposit', 'User\StatementsControllers@deposit');
    Route::post('finance/deposit', 'User\StatementsControllers@deposit');

    Route::get('users/{id}', function ($id) { });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('', 'User\CartsController@cart');
        Route::get('delete', 'User\CartsController@delete');
        Route::get('update', 'User\CartsController@update');
        Route::get('empty', 'User\CartsController@empty');
        Route::post('make_order', 'User\CartsController@make_order');
        Route::post('add_order', 'User\CartsController@add_order');
    });

    Route::group(['prefix' => 'transport'], function () {
        // Route::get('request_transport', 'User\TransportsController@request_transport');
        Route::post('send_request', 'User\TransportsController@send_request');
        Route::post('pay_shipfee', 'User\TransportsController@pay_shipfee');
        // Route::get('wait_for_pay', 'User\TransportsController@wait_for_pay');
        // Route::get('bill_transport', 'User\TransportsController@bill_transport');
        // Route::get('bill_transport/{id}', 'User\TransportsController@bill_transport');
        Route::get('list/{status}', 'User\TransportsController@index');
        Route::get('choose_address_api', 'User\TransportsController@choose_address_api');

        Route::post('add_address', 'User\TransportsController@add_address');
        Route::post('edit_address', 'User\TransportsController@edit_address');
        Route::get('delete_address/{id}', 'User\TransportsController@delete_address');
        Route::post('upload_img', 'User\TransportsController@upload_img');
        Route::get('received_goods/{id}', 'User\TransportsController@received_goods');
    });

    Route::group(['prefix' => 'complaints'], function () {
        Route::get('', 'User\ComplaintsControllers@index');
        Route::get('all', 'User\ComplaintsControllers@index');
        Route::get('detail/{id}', 'User\ComplaintsControllers@detail');
        Route::get('add/{id}', 'User\ComplaintsControllers@add');
        Route::post('add/{id}', 'User\ComplaintsControllers@add');
        Route::get('edit/{id}', 'User\ComplaintsControllers@edit');
        Route::post('edit/{id}', 'User\ComplaintsControllers@edit');
        Route::get('delete/{id}', 'User\ComplaintsControllers@delete');
    });
});

Route::group(['prefix' => 'bai-viet'], function () {
    Route::get('{any}', 'User\PostsControllers@index');
    Route::get('chi-tiet/{id}', 'User\PostsControllers@detail');
});

Route::get('gioi-thieu', 'User\WriteControllers@about');
Route::get('huong-dan', 'User\WriteControllers@document');
Route::get('chinh-sach', 'User\WriteControllers@policy');