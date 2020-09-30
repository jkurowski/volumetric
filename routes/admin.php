<?php

//GET	    /photos	                    index()         photos.index
//GET	    /photos/create	            create()        photos.create
//POST	    /photos	                    store()	        photos.store
//GET	    /photos/{photo}	            show()	        photos.show
//GET	    /photos/{photo}/edit	    edit()	        photos.edit
//PUT/PATCH	/photos/{photo}	            update()	    photos.update
//DELETE	/photos/{photo}	            destroy()	    photos.destroy

// Pages
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/page', 'as' => 'admin.page.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'PageController@index')->name('index');
    Route::get('/create',                       'PageController@create')->name('create');
    Route::post('/',                            'PageController@store')->name('store');
    Route::get('/{page}/edit',                  'PageController@edit')->name('edit');
    Route::put('/{page}',                       'PageController@update')->name('update');
    Route::delete('/{page}',                    'PageController@destroy')->name('destroy');

    Route::put('/up/{page}',                    'PageController@up')->name('up');
    Route::put('/down/{page}',                  'PageController@down')->name('down');
});


// Slider
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/slider', 'as' => 'admin.slider.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'SliderController@index')->name('index');
    Route::get('/create',                        'SliderController@create')->name('create');
    Route::post('/',                            'SliderController@store')->name('store');
    Route::get('/{slider}/edit',                 'SliderController@edit')->name('edit');
    Route::put('/{slider}',                      'SliderController@update')->name('update');
    Route::delete('/{slider}',                   'SliderController@destroy')->name('destroy');

    Route::post('set',                          'SliderController@sort')->name('sort');
});

// Robimy aktualnosci
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/article', 'as' => 'admin.article.', 'middleware' => 'auth'], function() {

    Route::get('/',                             'ArticleController@index')->name('index');
    Route::get('/create',                       'ArticleController@create')->name('create');
    Route::post('/',                            'ArticleController@store')->name('store');
    Route::get('/{article}/edit',                'ArticleController@edit')->name('edit');
    Route::put('/{article}',                     'ArticleController@update')->name('update');
    Route::delete('/{article}',                  'ArticleController@destroy')->name('destroy');

});


// DeveloPro
Route::group(['namespace' => 'Admin', 'prefix'=>'/admin/developro', 'as' => 'admin.developro.', 'middleware' => 'auth'], function() {

    Route::get('/',                                 'InvestmentController@index')->name('index');
    Route::get('/create',                           'InvestmentController@create')->name('create');
    Route::post('/',                                'InvestmentController@store')->name('store');
    Route::get('/{investment}/edit',                'InvestmentController@edit')->name('edit');
    Route::put('/{investment}',                     'InvestmentController@update')->name('update');
    Route::delete('/{investment}',                  'InvestmentController@destroy')->name('destroy');

    Route::get('plan/{investment}',                 'InvestmentPlanController@index')->name('plan.index');
    Route::post('plan/{investment}/update',         'InvestmentPlanController@update')->name('plan.update');

    Route::get('/floors/{investment}',              'InvestmentFloorController@index')->name('floor.index');
    Route::get('/floors/{investment}/create',       'InvestmentFloorController@create')->name('floor.create');
    Route::post('/floors/{investment}',             'InvestmentFloorController@store')->name('floor.store');
    Route::get('/floors/{floor}/edit',              'InvestmentFloorController@edit')->name('floor.edit');
    Route::put('/floors/{floor}',                   'InvestmentFloorController@update')->name('floor.update');
    Route::delete('/floors/{floor}',                'InvestmentFloorController@destroy')->name('floor.destroy');

    Route::get('/investment/{investment}/floor/{floor}/show',               'InvestmentPropertyController@index')->name('property.index');
    Route::get('/property/{floor}/create',          'InvestmentPropertyController@create')->name('property.create');
    Route::post('/property/{floor}',                'InvestmentPropertyController@store')->name('property.store');
    Route::get('/property/{property}/edit',         'InvestmentPropertyController@edit')->name('property.edit');
    Route::put('/property/{property}',              'InvestmentPropertyController@update')->name('property.update');
    Route::delete('/property/{property}',           'InvestmentPropertyController@destroy')->name('property.destroy');

    Route::get('/{investment}/houses',              'InvestmentHouseController@index')->name('house.index');
    Route::get('/house/{investment}/create',        'InvestmentHouseController@create')->name('house.create');
    Route::post('/house/{investment}',              'InvestmentHouseController@store')->name('house.store');
    Route::get('/house/{property}/edit',            'InvestmentHouseController@edit')->name('house.edit');
    Route::put('/house/{property}',                 'InvestmentHouseController@update')->name('house.update');
    Route::delete('/house/{property}',              'InvestmentHouseController@destroy')->name('house.destroy');

});

Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)');
