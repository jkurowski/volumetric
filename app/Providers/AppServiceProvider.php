<?php

namespace App\Providers;

use Request;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

use App\Models\Investment;
use App\Observers\InvestmentObserver;

use App\Models\Url;
use App\Observers\UrlObserver;

use App\Models\Page;
use App\Observers\PageObserver;

use App\Models\Boxes;
use App\Observers\BoxObserver;

use App\Models\Gallery;
use App\Observers\GalleryObserver;

use App\Models\Image;
use App\Observers\ImageObserver;

use App\Models\Article;
use App\Observers\ArticleObserver;

use App\Models\RodoClient;
use App\Observers\RodoClientObserver;

use App\Models\Slider;
use App\Observers\SliderObserver;

use App\Models\Settings;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });
        $this->app->bind('App\Repositories\EloquentRepositoryInterface', 'App\Repositories\BaseRepository');
        $this->app->bind('App\Repositories\UserRepositoryInterface', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\SliderRepositoryInterface', 'App\Repositories\SliderRepository');
        $this->app->bind('App\Repositories\BoxRepositoryInterface', 'App\Repositories\BoxRepository');
        $this->app->bind('App\Repositories\ArticleRepositoryInterface', 'App\Repositories\ArticleRepository');
        $this->app->bind('App\Repositories\PageRepositoryInterface', 'App\Repositories\PageRepository');
        $this->app->bind('App\Repositories\UrlRepositoryInterface', 'App\Repositories\UrlRepository');
        $this->app->bind('App\Repositories\ImageRepositoryInterface', 'App\Repositories\ImageRepository');
        $this->app->bind('App\Repositories\InvestmentRepositoryInterface', 'App\Repositories\InvestmentRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Activity::saving(function (Activity $activity) {

            $activity->properties = collect([
                    "route"         => Request::getPathInfo(),
                    "ipAddress"     => Request::ip(),
                    "userAgent"     => Request::header('user-agent'),
                    "locale"        => Request::header('accept-language'),
                    "referer"       => Request::header('referer'),
                    "methodType"    => Request::method()
            ]);
        });

        Image::observe(ImageObserver::class);
        Gallery::observe(GalleryObserver::class);
        Article::observe(ArticleObserver::class);
        RodoClient::observe(RodoClientObserver::class);
        Slider::observe(SliderObserver::class);
        Boxes::observe(BoxObserver::class);
        Article::observe(ArticleObserver::class);
        Page::observe(PageObserver::class);
        Url::observe(UrlObserver::class);
        Image::observe(ImageObserver::class);
        Investment::observe(InvestmentObserver::class);
    }
}
