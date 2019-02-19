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

Route::get('/', function () {
    return view('site/home/index');
});

Auth::routes();

Route::get('/dashboard', 'AdminController@index')->name('dashboard');

Route::middleware(['auth'])->prefix('dashboard')->namespace('Admin')->group(function () {
    Route::resource('eventos', 'EventController');
    Route::get('eventos/detail/{id}', 'EventController@detail');
    Route::resource('lotes', 'LotController');
    Route::get('ingressos', 'TicketController')->name('ingressos.index');
    Route::resource('usuarios', 'UserController')->middleware('can:isAdmin');
    Route::resource('administradores', 'AdmController')->middleware('can:isAdmin');
});
