<?php

namespace App\Notifications;

use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLesson extends Notification implements ShouldQueue
{
    use Queueable;

    protected Lesson $lesson;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
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
            'message' => 'You have a new lesson: ' . $this->lesson->name,
            'link' => route('student.course.section.lesson.show', ['lesson' => $this->lesson, 'section' => $this->lesson->section, 'course' => $this->lesson->section->course]),
            'lesson' => $this->lesson
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
