<?php

use Illuminate\Support\Facades\Route;

// Inbox
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/inbox', 'as' => 'admin.inbox.', 'middleware' => 'auth'], function() {

    Route::get('/',
        'InboxController@index')->name('index');

    Route::get('/admin/inbox/message/{id}',
        'InboxController@show')->name('show');

});

// kCMS
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {

    Route::get('/', function () {
        return redirect('admin/developro');
    });

    // Slider
    Route::post('slider/set', 'SliderController@sort')->name('slider.sort');
    Route::post('gallery/set', 'GalleryController@sort')->name('gallery.sort');

    Route::resources([
        'page' => 'PageController',
        'article' => 'ArticleController',
        'slider' => 'SliderController',
        'user' => 'UserController',
        'role' => 'RoleController',
        'logs' => 'LogController',
        'gallery' => 'GalleryController'
    ]);

    // RODO
    Route::group(['prefix'=>'/rodo', 'as' => 'rodo.'], function() {

        Route::resources([
            'rules' => 'RodoRulesController',
            'settings' => 'RodoSettingsController'
        ]);

    });
});

// DeveloPro
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {

    // Inwestycje

    Route::resource('developro', 'InvestmentController')->except('show');

    // Plan inwestycji

    Route::group(['prefix'=>'/plan', 'as' => 'developro.plan.'], function() {

        Route::get('{investment}',
            'InvestmentPlanController@index')->name('index');

        Route::post('{investment}/update',
            'InvestmentPlanController@update')->name('update');
    });

    Route::group(['as' => 'developro.'], function() {
        Route::resources([
            // Inwestycja budynkowa
            'investment.floor' => 'InvestmentFloorController',
            'investment.floor.property' => 'InvestmentPropertyController',

            // Inwestycja osiedlowa
            'investment.building' => 'InvestmentBuildingController',
            'investment.building.floor' => 'InvestmentBuildingFloorController',
            'investment.building.floor.property' => 'InvestmentBuildingPropertyController',

            // Inwestycja domkowa
            'investment.house' => 'InvestmentHouseController'
        ]);
    });
});

Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)');
