<?php

namespace App\Providers;

use App\Matchers\AgentContactMatcher;
use App\Matchers\ZipCodeDistanceMatcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AgentContactMatcher::class, ZipCodeDistanceMatcher::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
