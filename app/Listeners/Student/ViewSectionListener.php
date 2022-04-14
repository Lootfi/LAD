<?php

namespace App\Listeners\Student;

use App\Events\Student\ViewSection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ViewSectionListener
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
     * @param  \App\Events\Student\ViewSection  $event
     * @return void
     */
    public function handle(ViewSection $event)
    {
        //
    }
}
