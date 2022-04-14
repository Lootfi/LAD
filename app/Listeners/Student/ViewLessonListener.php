<?php

namespace App\Listeners\Student;

use App\Events\Student\ViewLesson;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ViewLessonListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Student\ViewLesson  $event
     * @return void
     */
    public function handle(ViewLesson $event)
    {
        //
    }
}
