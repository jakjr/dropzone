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

        \Route::post('dropzone', 'Jakjr\Dropzone\DropzoneController@uploadAttach')->middleware('web');
        \Route::delete('dropzone', 'Jakjr\Dropzone\DropzoneController@deleteAttach')->middleware('web');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('dropzone', function($app){
            return new Dropzone();
        });
    }
}
