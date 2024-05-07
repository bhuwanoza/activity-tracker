<?php

namespace Nrm\ActivityTracker\Providers;
use Illuminate\Support\ServiceProvider;
use Nrm\ActivityTracker\Middleware\ActivityTracker;

class ActivityTrackerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['router']->aliasMiddleware('nrm-activity-tracker', ActivityTracker::class);
    }
}
