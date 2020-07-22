<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IssueFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\IIssueFactory', function ($app) {
            return new \App\Factories\IssueFactory();
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
