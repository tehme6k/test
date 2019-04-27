<?php

use Carbon\Carbon;

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

Route::get('/layouttest', 'HomeController@test');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/bprs', 'BprController');
Route::resource('/mprs', 'MprController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/products', 'ProductsController');
Route::resource('/projects', 'ProjectsController');
Route::resource('/boxes', 'BoxesController');
Route::resource('/users', 'UsersController');
Route::resource('inventories', 'InventoryController');


Route::put('bprs/{bpr}/approve', 'BprController@approve')->name('bprs.approve');
Route::put('bprs/{bpr}/reject', 'BprController@reject')->name('bprs.reject');
Route::put('mprs/{mpr}/approve', 'MprController@approve')->name('mprs.approve');
Route::post('mprs/add/', 'MprController@addProduct')->name('mpr.add');
Route::put('inventories/{inventory}/approve', 'InventoryController@approve')->name('inventories.approve');
Route::put('inventories/{inventory}/reject', 'InventoryController@reject')->name('inventories.reject');
Route::post('/inventories/powder', 'InventoryController@powderstore')->name('inventories.powder.store');
Route::post('/inventories/nonpowder', 'InventoryController@nonpowderstore')->name('inventories.nonpowder.store');

Route::get('/boxes/{box}/print', 'BoxesController@print')->name('box.print');


Route::get('/retention/closed', 'RetentionController@closed')->name('ret.closed');
Route::post('retention/add/{box}/', 'RetentionController@add')->name('retention.add');



Route::put('/reopened/{box}/', 'ReopenController@open')->name('boxes.reopen');
Route::get('/reopened/show/{box}/{reopenedboxes}', 'ReopenController@show')->name('reopen.show');
Route::put('/reopened/box/{box}/{reopenedboxes}', 'ReopenController@close')->name('reopen.close');





