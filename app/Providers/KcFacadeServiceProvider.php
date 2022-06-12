<?php

namespace App\Providers;

use App;
use App\Services\KC\kc;
use Illuminate\Support\ServiceProvider;

class KcFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Kc', function () {
            return new Kc;
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
