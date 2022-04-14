<?php

namespace App\Listeners\Student;

use App\Events\Student\ViewCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ViewCourseListener
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
     * @param  \App\Events\Student\ViewCourse  $event
     * @return void
     */
    public function handle(ViewCourse $event)
    {
        // log activity
        activity('student.course.show')
            ->causedBy($event->student)
            ->performedOn($event->course)
            ->log('Student viewed course');
    }
}
