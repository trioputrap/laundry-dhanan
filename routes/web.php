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


Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', 'PengerjaanController@index')->name('home');

    Route::group(['prefix' => 'konsumen'], function()
    {
        Route::get('/', 'KonsumenController@index')->name('konsumen.index');
        Route::post('/store', 'KonsumenController@store')->name('konsumen.store');
        Route::post('/update/{id}', 'KonsumenController@update')->name('konsumen.update');
        Route::post('/delete/{konsumen}', 'KonsumenController@destroy')->name('konsumen.delete');
        Route::post('/login', 'KonsumenController@login')->name('konsumen.login');
    }); 
    Route::group(['prefix' => 'pegawai'], function()
    {
        Route::get('/', 'PegawaiController@index')->name('pegawai.index');
        Route::post('/store', 'PegawaiController@store')->name('pegawai.store');
        Route::get('/edit/{pegawai}', 'PegawaiController@edit')->name('pegawai.edit');
        Route::post('/update/{pegawai}', 'PegawaiController@update')->name('pegawai.update');
        Route::post('/delete/{pegawai}', 'PegawaiController@destroy')->name('pegawai.delete');
    }); 
    

    Route::group(['prefix' => 'layanan'], function()
    {
        Route::get('/', 'LayananController@index')->name('layanan.index');
        Route::post('/store', 'LayananController@store')->name('layanan.store');
        Route::post('/update/{id}', 'LayananController@update')->name('layanan.update');
        Route::post('/delete/{layanan}', 'LayananController@destroy')->name('layanan.delete');
    }); 

    Route::group(['prefix' => 'pengerjaan'], function()
    {
        Route::get('/', 'PengerjaanController@index')->name('pengerjaan.index');
        Route::post('/store', 'PengerjaanController@store')->name('pengerjaan.store');
        Route::post('/update/{id}', 'PengerjaanController@update')->name('pengerjaan.update');
        Route::post('/delete/{pengerjaan}', 'PengerjaanController@destroy')->name('pengerjaan.delete');
        Route::get('/print/{pengerjaan}', 'PengerjaanController@print')->name('pengerjaan.print');
    }); 
}); 