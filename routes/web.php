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

// Bill Routes
Route::get('/', 'BillController@index')->name('bill.index');
Route::get('bill/create', 'BillController@create')->name('bill.create');
Route::post('bill', 'BillController@store')->name('bill.store');
Route::get('bill/{bill}/edit', 'BillController@edit')->name('bill.edit');
Route::put('bills/{bill}/update', 'BillController@update')->name('bill.update');
Route::get('bill/{id}/restore', 'BillController@restore')->name('bill.restore');
Route::delete('bill/{id}/delete', 'BillController@destroy')->name('bill.destroy');
// End Bill Routes


// Import Routes
Route::get('import', 'BillController@importView')->name('sheet');
Route::post('import', 'BillController@import')->name('import');
// End Import Routes
