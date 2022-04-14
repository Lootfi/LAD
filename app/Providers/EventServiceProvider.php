<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // Student view course
        'App\Events\Student\ViewCourse' => [
            'App\Listeners\Student\ViewCourseListener',
        ],
        // Student view section
        'App\Events\Student\ViewSection' => [
            'App\Listeners\Student\ViewSectionListener',
        ],
        // Student view lesson
        'App\Events\Student\ViewLesson' => [
            'App\Listeners\Student\ViewLessonListener',
        ],
        // Student view quiz
        'App\Events\Student\ViewQuiz' => [
            'App\Listeners\Student\ViewQuizListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
