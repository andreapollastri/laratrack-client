<?php

namespace Andr3a\Laratrack;

use Illuminate\Support\ServiceProvider;

class LaratrackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laratrack.php'),
            ], 'laratrack-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laratrack');

        $this->app->singleton('laratrack', function () {
            return new Laratrack();
        });
    }
}
