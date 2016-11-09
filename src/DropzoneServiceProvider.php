<?php

namespace Jakjr\Dropzone;

use Illuminate\Support\ServiceProvider;

class DropzoneServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/dropzone'),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('dropzone', function($app){
            return new Dropzone();
        });
    }
}
