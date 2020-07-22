<?php

namespace App\Providers;

use App\Models\TaskManager\Source;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\TaskManager\Issue;
use App\Models\TaskManager\Project;
use App\Observers\UserObserver;
use App\Observers\IssueObserver;
use App\Observers\ProjectObserver;
use App\Observers\SourceObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Issue::observe(IssueObserver::class);
        Project::observe(ProjectObserver::class);
        Source::observe(SourceObserver::class);
    }
}
