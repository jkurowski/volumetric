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

Auth::routes();

Route::get('/', 'Front\IndexController@index')->name('index');

// Developro
Route::group(['namespace' => 'Front', 'prefix'=>'/inwestycje', 'as' => 'front.investment.'], function() {
    Route::get('/',                             'InvestmentController@index')->name('index');
    Route::get('/{investment}',                 'InvestmentController@show')->name('show');

    Route::get('/{investment}/pietro/{floor}',  'InvestmentFloorController@index')->name('floor.index');
    Route::get('/{investment}/pietro/{floor}/m/{property}',  'InvestmentPropertyController@index')->name('property.index');

    Route::get('/{investment}/b/{building}',  'InvestmentBuildingController@index')->name('building.index');
    Route::get('/{investment}/b/{building}/pietro/{floor}',  'InvestmentBuildingFloorController@index')->name('building.floor.index');
    Route::get('/{investment}/b/{building}/pietro/{floor}/m/{property}',  'InvestmentBuildingPropertyController@index')->name('building.property.index');

    Route::get('/{investment}/d/{property}',  'InvestmentHouseController@index')->name('house.index');
});


// Articles
Route::group(['namespace' => 'Front', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {
    Route::get('/',         'ArticleController@index')->name('index');
    Route::get('/{slug}',   'ArticleController@show')->name('show');
});
