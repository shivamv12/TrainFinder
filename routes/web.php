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
Route::get('rail-index', 'TrainController@index')->name('rail-index');
Route::prefix('trainInfo')->group(function () {
    Route::get('search-by-number', 'TrainController@searchByNumber')->name('trainInfo.searchByNumber');
    Route::get('search-by-name', 'TrainController@searchByName')->name('trainInfo.searchByName');
    Route::get('map-direction', 'TrainController@direction')->name('trainInfo.mapdirection');

    Route::post('search-train-by-name','TrainController@searchTrainByName')->name('trainInfo.searchtrainbyname');
});
