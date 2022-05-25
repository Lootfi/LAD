<?php

namespace App\Events\Student;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\User;
use App\Notifications\QuizKcAwarenessWarning as NotificationsQuizKcAwarenessWarning;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuizKcAwarenessWarning implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $lessons;
    public $kcs;
    public string $message = '';
    protected Quiz $quiz;
    protected User $student;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz, User $student, $kc_ids)
    {
        $this->quiz = $quiz;
        $this->student = $student;
        $kcs = collect();
        $lessons = [];
        $this->message = 'Please revise these concepts: ';

        $last_key = array_key_last($kc_ids);
        foreach ($kc_ids as $kc_id => $awareness) {
            $kc = Kc::query()->where('id', $kc_id)->first();

            if($awareness == 0 || $awareness == -1) {
                $kcs->push($kc);
                $lessons[$kc_id] = $kc->lessons;
            }

            if ($kc_id == $last_key) {
                $this->message = $this->message . $kc->name . '.';
            } else {
                $this->message = $this->message . $kc->name . ', ';
            }
        }

        $this->kcs = $kcs;
        $this->lessons = $lessons;

        $student->notify(new NotificationsQuizKcAwarenessWarning($this->message));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('quiz.' . $this->quiz->id . '.student.' . $this->student->id . '.kcs');
    }
}
