<?php

namespace App\Providers;

use App\Helpers\TMHelper;
use Illuminate\Support\ServiceProvider;

class TMHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('TMHelper', function () {
            return new TMHelper();
        });
    }
}
