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

Route::namespace('App\Http\Controllers')->group(function(){

    Route::get('login', 'penggunaController@login');
    Route::delete('login', 'penggunaController@logout');

    Route::group(['prefix'=>'pengguna', ], function(){
        Route::patch('/', 'penggunaController@update');
        Route::post('/photo', 'penggunaController@simpan_photo');
        Route::get('/photo', 'penggunaController@photo');
    });

    Route::prefix('pemesanan')->group(function(){
        Route::post('/','pemesananController@store');
        Route::patch('/{w}', 'pemesananController@update');
        Route::delete('/{w}', 'pemesananController@delete');
        Route::post('/photo', 'pemesananController@simpan_photo');
        Route::get('/{w}', 'pemesananController@show');
    });
    
});
