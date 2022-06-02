<?php
use Illuminate\Support\Facades\Route;

// Inbox
Route::group([
    'namespace' => 'Admin\Inbox',
    'prefix' => '/admin/inbox',
    'as' => 'admin.inbox.',
    'middleware' => 'auth'], function () {

        Route::get(
            '/',
            'IndexController@index'
        )->name('index');

        Route::get(
            '/admin/inbox/message/{id}',
            'IndexController@show'
        )->name('show');
    });

// kCMS
Route::group([
    'namespace' => 'Admin',
    'prefix'=>'/admin',
    'as' => 'admin.',
    'middleware' => 'auth'], function () {

        Route::get('/', function () {
            return redirect('admin/developro');
        });

    // Slider
        Route::post('slider/set', 'Slider\IndexController@sort')->name('slider.sort');
        Route::post('gallery/set', 'Gallery\IndexController@sort')->name('gallery.sort');
        Route::post('image/set', 'Gallery\ImageController@sort')->name('image.sort');
        Route::post('box/set', 'Box\IndexController@sort')->name('box.sort');
        Route::post('developro/set', 'Developro\IndexController@sort')->name('developro.sort');


    // Gallery
        Route::get('ajaxGetGalleries', 'Gallery\IndexController@ajaxGetGalleries')->name('ajaxGetGalleries');

        Route::resources([
            'dictionary' => 'Dictionary\IndexController',
            'page' => 'Page\IndexController',
            'url' => 'Url\IndexController',
            'article' => 'Article\IndexController',
            'slider' => 'Slider\IndexController',
            'box' => 'Box\IndexController',
            'user' => 'User\IndexController',
            'role' => 'Role\IndexController',
            'logs' => 'Log\IndexController',
            'greylist' => 'Greylist\IndexController',
            'gallery' => 'Gallery\IndexController',
            'image' => 'Gallery\ImageController',
            'map' => 'Map\IndexController'
        ]);

    Route::get('dictionary/{slug}/{locale}/edit', 'Dictionary\IndexController@edit')->name('dictionary.edit');

    // RODO
        Route::group(['prefix' => '/rodo', 'as' => 'rodo.'], function () {

            Route::resources([
            'rules' => 'Rodo\RulesController',
            'settings' => 'Rodo\SettingsController',
            'clients' => 'Rodo\ClientController'
            ]);
        });

    // Tracker
        Route::group(['prefix'=>'/tracker', 'as' => 'tracker.'], function () {

            Route::get('/', 'Tracker\IndexController@index')->name('index');
            Route::get('errors', 'Tracker\IndexController@errors')->name('errors');
            Route::get('apiErrors', 'Tracker\IndexController@apiErrors')->name('apiErrors');
            Route::get('events', 'Tracker\IndexController@events')->name('events');
            Route::get('apiEvents', 'Tracker\IndexController@apiEvents')->name('apiEvents');
            Route::get('event/{id}', 'Tracker\IndexController@event')->name('event');
            Route::get('apiVisits', 'Tracker\IndexController@apiVisits')->name('apiVisits');
            Route::get('log/{uuid}', 'Tracker\IndexController@log')->name('log');
            Route::get('apiLog/{uuid}', 'Tracker\IndexController@apiLog')->name('apiLog');
        });

    // Dashboard
        Route::group(['prefix'=>'/dashboard', 'as' => 'dashboard.'], function () {

            Route::resources([
            'seo' => 'Dashboard\SeoController',
            'social' => 'Dashboard\SocialController'
            ]);
        });
    });

// DeveloPro
Route::group([
    'namespace' => 'Admin\Developro',
    'prefix' => '/admin',
    'as' => 'admin.',
    'middleware' => 'auth'], function () {

    Route::resource('developro', 'IndexController')->except('show');
});

Route::get('{uri}', 'Front\MenuController@index')->where('uri', '([A-Za-z0-9\-\/]+)');
