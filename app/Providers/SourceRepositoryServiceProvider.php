<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SourceRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\ISourceRepository', function ($app) {
            return new \App\Repositories\SourceRepository();
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
