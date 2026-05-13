<?php

namespace App\Providers;

use App\Models\Equipment;
use App\Models\Project;
use App\Models\Service;
use App\Observers\ContentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Equipment::observe(ContentObserver::class);
        Service::observe(ContentObserver::class);
        Project::observe(ContentObserver::class);
    }
}
