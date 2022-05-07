<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RubixServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/rubixai_config.php', 'rubixai');
        if (!defined('RUBIX_CUSTOM_CONFIG')) {
            define('RUBIX_CUSTOM_CONFIG', config('rubix'));
        }

        $this->app->singleton('rubixai', function ($app) {
            return new RubixService;
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


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rubix'];
    }
}
