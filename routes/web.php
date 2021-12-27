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

Route::get('/', 'AdminController@home');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AuthAdminController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AuthAdminController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AuthAdminController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@home')->name('admin.home');

    Route::post('/config', 'AdminController@config');
    Route::get('/config/datatable', 'AdminController@datatable');
    Route::post('/store/{target}', 'AdminController@store');
    Route::post('/update/{target}', 'AdminController@update');
    Route::get('/delete/{target}/{id}', 'AdminController@delete');

    Route::get('/{page}', 'AdminController@page');
    Route::get('/{dir}/{page}', 'AdminController@pagedir');
});

Route::group(['prefix' => 'sekolah'], function () {
    Route::get('/login', 'Auth\AuthSekolahController@showLoginForm')->name('sekolah.login');
    Route::post('/login', 'Auth\AuthSekolahController@login')->name('sekolah.login.submit');
    Route::get('/logout', 'Auth\AuthSekolahController@logout')->name('sekolah.logout');
    Route::get('/', 'SekolahController@home')->name('sekolah.home');

    Route::post('/config', 'SekolahController@config');
    Route::post('/store/{target}', 'SekolahController@store');
    Route::post('/update/{target}', 'SekolahController@update');
    Route::get('/delete/{target}/{id}', 'SekolahController@delete');

    Route::get('/{page}', 'SekolahController@page');
    Route::get('/{dir}/{page}', 'SekolahController@pagedir');
});