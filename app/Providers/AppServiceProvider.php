<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        \Schema::defaultStringLength(350);
        //\Carbon\Carbon::setToStringFormat('d-m-Y h:i A');


        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
       }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
           if (env('REDIRECT_HTTPS'))
           {
               $url->formatScheme('https://');
               // Model::preventLazyLoading(!app()->isProduction());
          }
    }
}
