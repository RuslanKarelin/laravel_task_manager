<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FileRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\Repositories\IFileRepository', function ($app) {
            return new \App\Repositories\FileRepository();
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
