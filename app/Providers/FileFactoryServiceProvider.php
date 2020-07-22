<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\IFileFactory', function ($app) {
            return new \App\Factories\FileFactory();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
