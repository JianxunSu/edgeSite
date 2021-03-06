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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stores', 'StoreController@index')->name('stores');
// Route::resource('supervisors', 'SupervisorController');
Route::get('/supervisors', 'SupervisorController@index')->name('supervisors');
Route::get('/supervisor_form/{id}', 'SupervisorController@manageSupervisor')->name('supervisor_form');
Route::post('/update_store/{id}', 'SupervisorController@updateStore')->name('updateStore');
