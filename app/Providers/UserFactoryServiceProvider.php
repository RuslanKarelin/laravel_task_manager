<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\IUserFactory', function ($app) {
            return new \App\Factories\UserFactory();
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
