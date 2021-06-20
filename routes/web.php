<?php

use App\Http\Controllers\Frontend\HomepageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/template', function () {
    return view('frontend.layout-frontend.main');
});

Route::namespace('Frontend')->group(function(){
    Route::get('/', 'HomepageController@index');
    Route::get('/pelayanan', 'HomepageController@pelayanan');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Backend')->group(function(){
    Route::post('/permohonan-ktp', 'PermohonanKtpKkController@storeKtp');
    Route::post('/permohonan-kk', 'PermohonanKtpKkController@storeKk');
});

Route::group(['prefix' => 'backend', 'namespace'=>'Backend', 'middleware' => 'auth'], function () {
    Route::get('/', 'DashboardBackendController@index');
    
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
        Route::get('/edit/{id}','UserRoleController@editUser');
        Route::post('update/{id?}', 'UserRoleController@storeUser');
        Route::get('delete/{id?}', 'UserRoleController@deleteUser');
    });

    Route::group(['prefix' => 'berita'], function () {
        Route::get('/', 'BeritaController@index');
        Route::get('/create', 'BeritaController@create');
        Route::post('/store', 'BeritaController@store');
        Route::get('/show/{id}', 'BeritaController@show');
        Route::get('/edit/{id}','BeritaController@edit');
        Route::post('/update/{id?}', 'BeritaController@update');
        Route::get('/delete/{id?}', 'BeritaController@delete');
    });


    
    Route::post('/register-front', 'UserRoleController@registerFrontUser');

    Route::get('/permohonan-ktp', 'PermohonanKtpKkController@getPermohonanKtp');
    Route::get('/permohonan-ktp/edit/{id?}', 'PermohonanKtpKkController@formEditKtp');
    Route::post('/permohonan-ktp/edit/{id?}', 'PermohonanKtpKkController@storeKtp');
    Route::get('/permohonan-ktp/delete/{id?}', 'PermohonanKtpKkController@deletePermohonanKtp');

    Route::get('permohonan-kk', 'PermohonanKtpKkController@getPermohonanKk');
    Route::get('permohonan-kk/edit/{id?}', 'PermohonanKtpKkController@formEditKk');
    Route::post('permohonan-kk/edit/{id?}', 'PermohonanKtpKkController@storeKk');
    Route::get('permohonan-kk/delete/{id?}', 'PermohonanKtpKkController@deletePermohonanKk');

    Route::get('ktp/approve-kelurahan/{id?}', 'PermohonanKtpKkController@ktpApproveKelurahan');
    Route::get('ktp/approve-rw/{id?}', 'PermohonanKtpKkController@ktpApproveRw');
    Route::get('ktp/approve-rt/{id?}', 'PermohonanKtpKkController@ktpApproveRt');

    Route::get('kk/approve-kelurahan/{id?}', 'PermohonanKtpKkController@kkApproveKelurahan');
    Route::get('kk/approve-rw/{id?}', 'PermohonanKtpKkController@kkApproveRw');
    Route::get('kk/approve-rt/{id?}', 'PermohonanKtpKkController@kkApproveRt');

});
