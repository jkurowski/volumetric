<?php

namespace App\Providers;

use Request;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Activity::saving(function (Activity $activity) {
            $json = json_encode(array(
                'route'         => Request::getPathInfo(),
                'ipAddress'     => Request::ip(),
                'userAgent'     => Request::header('user-agent'),
                'locale'        => Request::header('accept-language'),
                'referer'       => Request::header('referer'),
                'methodType'    => Request::method()
            ));
            $json_string = stripslashes($json);
            $activity->properties = json_decode($json_string, true);
        });
    }
}
