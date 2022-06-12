<?php

namespace App\Providers;

use App;
use App\Services\Quiz\Quiz;
use Illuminate\Support\ServiceProvider;

class QuizFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('Quiz', function () {
            return new Quiz;
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
