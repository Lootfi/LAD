<?php

namespace App\Listeners\Student;

use App\Events\Student\ViewQuiz;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ViewQuizListener
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
     * @param  \App\Events\Student\ViewQuiz  $event
     * @return void
     */
    public function handle(ViewQuiz $event)
    {
        //
    }
}
