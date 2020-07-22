<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IssueRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\IIssueRepository', function ($app) {
            return new \App\Repositories\IssueRepository();
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
