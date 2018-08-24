<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $app = $this->app;

        $this->app->singleton('cloudder', function ($app) {
            return new \App\CloudinaryWrapper($app['config'], new \Cloudinary, new \Cloudinary\Uploader, new \Cloudinary\Api, new \Cloudinary\Search);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
