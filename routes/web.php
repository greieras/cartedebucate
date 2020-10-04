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

Route::get('/', 'HomeController@index');

 Auth::routes(['verify'=>true]);

Route::get('/home', 'AdminController@menu')->name('home')->middleware('verified');
Route::get('/menu-editor/{any?}', 'AdminController@menu')
    ->middleware('can:edit-menu')
    ->where('any', '.*');
