<?php

namespace App\Events\Student;

use App\Models\Course;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ViewCourse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $course;
    public $student;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $student, Course $course)
    {
        $this->course = $course;
        $this->student = $student;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
