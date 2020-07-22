<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\IProjectRepository', function ($app) {
            return new \App\Repositories\ProjectRepository();
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
