<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helper\Uploader;
use App;

class UploaderServiceProvider extends ServiceProvider
{
    protected $defer = false;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        App::bind('uploader', function () {
            return new Uploader();
        });

    }
}
