<?php

namespace App\Events\Student;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomQuizWarning implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Quiz $quiz;

    protected User $student;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz, User $student, $message)
    {
        $this->quiz = $quiz;
        $this->student = $student;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('quiz.'.$this->quiz->id.'.student.'.$this->student->id.'.kcs');
    }
}
