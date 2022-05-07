<?php

namespace App\Notifications;

use App\Models\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewQuiz extends Notification implements ShouldQueue
{
    use Queueable;

    // quiz
    protected Quiz $quiz;

    /**
     * Create a new notification instance. takes quiz object as parameter to be used in the notification message body
     *
     * @return void
     */
    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'You have a new quiz: ' . $this->quiz->name,
            'link' => route('student.quiz.show', ['quiz' => $this->quiz, 'course' => $this->quiz->course]),
            'quiz' => $this->quiz
        ];
    }


    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'You have a new quiz: ' . $this->quiz->name,
            'link' => route('student.quiz.show', ['quiz' => $this->quiz, 'course' => $this->quiz->course]),
            'quiz' => $this->quiz
        ]);
    }
}
