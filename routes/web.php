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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'backend', 'namespace'=>'Backend'], function () {
    Route::get('/', 'DashboardBackendController@index');
    
    Route::group(['prefix' => 'user-role'], function () {
        Route::get('/role', 'UserRoleController@indexRole');
        Route::post('/role/store', 'UserRoleController@storeRole');
        Route::get('/role/delete/{id?}', 'UserRoleController@deleteRole');
    }); 

    Route::group(['prefix' => 'user-rt'], function () {
        Route::get('/', 'UserRoleController@indexRt');
        Route::post('/store', 'UserRoleController@storeRt');
        Route::get('delete/{id?}', 'UserRoleController@deleteRt');
    }); 

    Route::group(['prefix' => 'user-rw'], function () {
        Route::get('/', 'UserRoleController@indexRw');
        Route::post('/store', 'UserRoleController@storeRw');
        Route::get('delete/{id?}', 'UserRoleController@deleteRw');
    }); 

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserRoleController@indexUser');
        Route::get('/create', 'UserRoleController@registerUser');
        Route::post('/store', 'UserRoleController@storeUser');
        Route::get('/edit/{id?}','UserController@editUser');
        Route::get('delete/{id?}', 'UserRoleController@deleteUser');
    }); 
    
});
