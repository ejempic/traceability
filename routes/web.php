<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('master-farmer', 'MasterFarmerController');

    Route::resource('purchase-order', 'PurchaseOrderController');

    Route::resource('farmer', 'FarmerController');
    Route::get('farmer-qr-print/{account}', 'FarmerController@farmerQrPrint')->name('farmer-qr-print');

    Route::resource('product', 'ProductController');
    Route::get('product-list', 'ProductController@productList')->name('product-list');

    Route::resource('inventory', 'InventoryController');
    Route::get('farmer-inventory-list', 'InventoryController@farmerInventoryList')->name('farmer-inventory-list');
    Route::get('farmer-inventory-list-item', 'InventoryController@farmerInventoryListItem')->name('farmer-inventory-list-item');
    Route::get('inv-listing/{account}', 'InventoryController@farmerInventoryListing')->name('inv-listing');
    Route::post('inv-listing-store', 'InventoryController@inventoryListingStore')->name('inv-listing-store');
    Route::get('inv-listing-delete', 'InventoryController@inventoryListingDelete')->name('inv-listing-delete');

    Route::resource('trace', 'TraceController');
    Route::post('trace-store', 'TraceController@traceStore')->name('trace-store');
    Route::get('trace-update-status', 'TraceController@traceUpdate')->name('trace-update-status');
    Route::get('trace-info/{code}', 'TraceController@traceInfo')->name('trace-info');
    Route::get('trace-qr-print/{reference}', 'TraceController@traceQrPrint')->name('trace-qr-print');

    Route::resource('user', 'UserController');
//        Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('user-list', 'UserController@userList')->name('user-list');
    Route::get('personnel-info', 'UserController@personnelInfo')->name('personnel-info');
    Route::post('create-user', 'UserController@createUser')->name('create-user');


    Route::get('role', 'RoleController@index')->name('role');
    Route::get('role-show/{id}', 'RoleController@show')->name('role-show');
    Route::post('role-update/{id}', 'RoleController@update')->name('role-update');
    Route::post('add-role', 'RoleController@addRole')->name('add-role');

});

