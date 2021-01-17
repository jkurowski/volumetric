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
Route::middleware(['restrictIp'])->group(function () {
    Auth::routes();

    Route::get('routes', function() {
        \Artisan::call('route:list');
        return '<pre>' . \Artisan::output() . '</pre>';
    });

    Route::get('/',
        'Front\IndexController@index')->name('index');

    Route::post('/property-contact/{property}',
        'Front\ContactController@property')->name('contact.property');

    Route::get('mapa',
        'Front\MapController@index')->name('map.index');

    Route::get('kontakt',
        'Front\ContactController@index')->name('contact.index');
    Route::post('kontakt',
        'Front\ContactController@send')->name('contact.send');

    // Developro
    Route::group(['namespace' => 'Front', 'prefix'=>'/inwestycje', 'as' => 'front.investment.'], function() {

    // Lista inwestycji

        Route::get('/',
            'InvestmentController@index')->name('index');

    // Glowny plan inwestycji

        Route::get('/{investment}',
            'InvestmentController@show')->name('show');

    // Inwestycja budynkowa

        Route::get('/{investment}/pietro/{floor}',
            'InvestmentFloorController@index')->name('floor.index');

        Route::get('/{investment}/pietro/{floor}/m/{property}',
            'InvestmentPropertyController@index')->name('property.index');

    // Inwestycja osiedlowa

        Route::group(['as' => 'building.'], function() {

            Route::get('/{investment}/b/{building}',
                'InvestmentBuildingController@index')->name('index');

            Route::get('/{investment}/b/{building}/pietro/{floor}',
                'InvestmentBuildingFloorController@index')->name('floor.index');

            Route::get('/{investment}/b/{building}/pietro/{floor}/m/{property}',
                'InvestmentBuildingPropertyController@index')->name('property.index');
        });

    // Inwestycja domkowa

        Route::get('/{investment}/d/{property}',
            'InvestmentHouseController@index')->name('house.index');
    });


    // Articles
    Route::group(['namespace' => 'Front', 'prefix'=>'/aktualnosci/', 'as' => 'front.news.'], function() {
        Route::get('/',         'ArticleController@index')->name('index');
        Route::get('/{slug}',   'ArticleController@show')->name('show');
    });

    // Inline
    Route::group(['namespace' => 'Front', 'prefix'=>'/inline/', 'as' => 'front.inline.'], function() {
        Route::get('/', 'InlineController@index')->name('index');
        Route::get('/loadinline/{inline}', 'InlineController@show')->name('show');
        Route::post('/update/{inline}', 'InlineController@update')->name('update');
    });
});
