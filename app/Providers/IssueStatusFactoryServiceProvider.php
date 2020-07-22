<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IssueStatusFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Factories\IIssueStatusFactory', function ($app) {
            return new \App\Factories\IssueStatusFactory();
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
