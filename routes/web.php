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

    Route::group(['prefix' => '{locale?}', 'where' => ['locale' => '(?!admin)*[a-z]{2}'],], function() {
        Route::group(['namespace' => 'Front'], function() {
            Route::get('/', 'IndexController@index')->name('index');
            Route::get('kontakt','ContactController@index')->name('contact.index');
            Route::get('poznajmy-sie','AboutController@index')->name('about.index');

            Route::group(['prefix'=>'/inwestycje/'], function() {
                Route::get('/w-sprzedazy', 'InvestmentController@index')->name('investment.index');
                Route::get('/w-przygotowaniu', 'PlannedController@index')->name('planned.index');
            });

            Route::post('kontakt', 'ContactController@send')->name('contact.send');
        });
    });

    // Inline
    Route::group(['namespace' => 'Front', 'prefix'=>'/inline/', 'as' => 'front.inline.'], function() {
        Route::get('/', 'InlineController@index')->name('index');
        Route::get('/loadinline/{inline}', 'InlineController@show')->name('show');
        Route::post('/update/{inline}', 'InlineController@update')->name('update');
    });
});
