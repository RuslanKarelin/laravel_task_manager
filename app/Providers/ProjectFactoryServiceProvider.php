<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\IProjectFactory', function ($app) {
            return new \App\Factories\ProjectFactory();
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
