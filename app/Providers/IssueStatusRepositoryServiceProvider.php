<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class IssueStatusRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\IIssueStatusRepository', function ($app) {
            return new \App\Repositories\IssueStatusRepository();
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
