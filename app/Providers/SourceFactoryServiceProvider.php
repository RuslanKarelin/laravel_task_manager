<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SourceFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\ISourceFactory', function ($app) {
            return new \App\Factories\SourceFactory();
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
