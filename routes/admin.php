<?php

use Illuminate\Support\Facades\Route;

//GET	    /photos	                    index()         photos.index
//GET	    /photos/create	            create()        photos.create
//POST	    /photos	                    store()	        photos.store
//GET	    /photos/{photo}	            show()	        photos.show
//GET	    /photos/{photo}/edit	    edit()	        photos.edit
//PUT/PATCH	/photos/{photo}	            update()	    photos.update
//DELETE	/photos/{photo}	            destroy()	    photos.destroy


// Pages
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/inbox', 'as' => 'admin.inbox.', 'middleware' => 'auth'], function() {

    Route::get('/',
        'InboxController@index')->name('index');

    Route::get('/admin/inbox/message/{id}', 'InboxController@show')->name('show');
});

// Pages
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/page', 'as' => 'admin.page.', 'middleware' => 'auth'], function() {

    Route::get('/',
        'PageController@index')->name('index');

    Route::get('/create',
        'PageController@create')->name('create');

    Route::post('/',
        'PageController@store')->name('store');

    Route::get('/{page}/edit',
        'PageController@edit')->name('edit');

    Route::put('/{page}',
        'PageController@update')->name('update');

    Route::delete('/{page}',
        'PageController@destroy')->name('destroy');

    Route::put('/up/{page}',
        'PageController@up')->name('up');

    Route::put('/down/{page}',
        'PageController@down')->name('down');
});

// Slider
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/slider', 'as' => 'admin.slider.', 'middleware' => 'auth'], function() {

    Route::get('/',
        'SliderController@index')->name('index');

    Route::get('/create',
        'SliderController@create')->name('create');

    Route::post('/',
        'SliderController@store')->name('store');

    Route::get('/{slider}/edit',
        'SliderController@edit')->name('edit');

    Route::put('/{slider}',
        'SliderController@update')->name('update');

    Route::delete('/{slider}',
        'SliderController@destroy')->name('destroy');

    Route::post('set',
        'SliderController@sort')->name('sort');
});

// Robimy aktualnosci
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/article', 'as' => 'admin.article.', 'middleware' => 'auth'], function() {

    Route::get('/',
        'ArticleController@index')->name('index');

    Route::get('/create',
        'ArticleController@create')->name('create');

    Route::post('/',
        'ArticleController@store')->name('store');

    Route::get('/{article}/edit',
        'ArticleController@edit')->name('edit');

    Route::put('/{article}',
        'ArticleController@update')->name('update');

    Route::delete('/{article}',
        'ArticleController@destroy')->name('destroy');
});

// DeveloPro
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/developro', 'as' => 'admin.developro.', 'middleware' => 'auth'], function() {

// Inwestycje

    Route::get('/',
        'InvestmentController@index')->name('index');

    Route::get('/create',
        'InvestmentController@create')->name('create');

    Route::post('/',
        'InvestmentController@store')->name('store');

    Route::get('/{investment}/edit',
        'InvestmentController@edit')->name('edit');

    Route::put('/{investment}',
        'InvestmentController@update')->name('update');

    Route::delete('/{investment}',
        'InvestmentController@destroy')->name('destroy');

    // Plan inwestycji

    Route::group(['as' => 'plan.'], function() {

        Route::get('plan/{investment}',
            'InvestmentPlanController@index')->name('index');

        Route::post('plan/{investment}/update',
            'InvestmentPlanController@update')->name('update');
    });

// Inwestycje budynkowa - pietra

    Route::group(['as' => 'floor.'], function() {

        Route::get('{investment}/floors',
            'InvestmentFloorController@index')->name('index');

        Route::get('/floors/{investment}/create',
            'InvestmentFloorController@create')->name('create');

        Route::post('/floors/{investment}',
            'InvestmentFloorController@store')->name('store');

        Route::get('/floors/{floor}/edit',
            'InvestmentFloorController@edit')->name('edit');

        Route::put('/floors/{floor}',
            'InvestmentFloorController@update')->name('update');

        Route::delete('/floors/{floor}',
            'InvestmentFloorController@destroy')->name('destroy');
    });

// Inwestycje budynkowa - mieszkania

    Route::group(['as' => 'property.'], function() {

        Route::get('/investment/{investment}/floor/{floor}',
            'InvestmentPropertyController@index')->name('index');

        Route::get('/properties/{floor}/create',
            'InvestmentPropertyController@create')->name('create');

        Route::post('/properties/{floor}',
            'InvestmentPropertyController@store')->name('store');

        Route::get('/properties/{property}/edit',
            'InvestmentPropertyController@edit')->name('edit');

        Route::put('/properties/{property}',
            'InvestmentPropertyController@update')->name('update');

        Route::delete('/properties/{property}',
            'InvestmentPropertyController@destroy')->name('destroy');
    });

// Inwestycja domkowa

    Route::group(['as' => 'house.'], function() {

        Route::get('/{investment}/houses',
            'InvestmentHouseController@index')->name('index');

        Route::get('/houses/{investment}/create',
            'InvestmentHouseController@create')->name('create');

        Route::post('/houses/{investment}',
            'InvestmentHouseController@store')->name('store');

        Route::get('/houses/{property}/edit',
            'InvestmentHouseController@edit')->name('edit');

        Route::put('/houses/{property}',
            'InvestmentHouseController@update')->name('update');

        Route::delete('/houses/{property}',
            'InvestmentHouseController@destroy')->name('destroy');
    });

// Inwestycja osiedlowa - budynki

    Route::group(['as' => 'building.'], function() {

        Route::get('/{investment}/buildings',
            'InvestmentBuildingController@index')->name('index');

        Route::get('/buildings/{investment}/create',
            'InvestmentBuildingController@create')->name('create');

        Route::post('/buildings/{investment}',
            'InvestmentBuildingController@store')->name('store');

        Route::get('/buildings/{building}/edit',
            'InvestmentBuildingController@edit')->name('edit');

        Route::put('/buildings/{building}',
            'InvestmentBuildingController@update')->name('update');

        Route::delete('/buildings/{building}',
            'InvestmentBuildingController@destroy')->name('destroy');
    });

// Inwestycja osiedlowa - pietra

    Route::group(['as' => 'building.floor.'], function() {

        Route::get('/building-floors/building/{building}',
            'InvestmentBuildingFloorController@index')->name('index');

        Route::get('/building-floors/{building}/create',
            'InvestmentBuildingFloorController@create')->name('create');

        Route::post('/building-floors/{building}',
            'InvestmentBuildingFloorController@store')->name('store');

        Route::get('/building-floors/{floor}/edit',
            'InvestmentBuildingFloorController@edit')->name('edit');

        Route::put('/building-floors/{floor}',
            'InvestmentBuildingFloorController@update')->name('update');

        Route::delete('/building-floors/{floor}',
            'InvestmentBuildingFloorController@destroy')->name('destroy');
    });

// Inwestycja osiedlowa - mieszkania

    Route::group(['as' => 'building.property.'], function() {

        Route::get('/building-properties/floor/{floor}',
            'InvestmentBuildingPropertyController@index')->name('index');

        Route::get('/building-properties/floor/{floor}/create',
            'InvestmentBuildingPropertyController@create')->name('create');

        Route::post('/building-properties/floor/{floor}',
            'InvestmentBuildingPropertyController@store')->name('store');

        Route::get('/building-properties/{property}/edit',
            'InvestmentBuildingPropertyController@edit')->name('edit');

        Route::put('/building-properties/{property}',
            'InvestmentBuildingPropertyController@update')->name('update');

        Route::delete('/building-properties/{property}',
            'InvestmentBuildingPropertyController@destroy')->name('destroy');
    });
});

Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)');
