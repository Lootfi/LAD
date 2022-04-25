<?php

namespace App\Events\Student;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionAnswered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Quiz $quiz;
    public QuizQuestion $question;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz, QuizQuestion $question)
    {
        $this->quiz = $quiz;
        $this->question = $question;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('student-activity');
    }
}
