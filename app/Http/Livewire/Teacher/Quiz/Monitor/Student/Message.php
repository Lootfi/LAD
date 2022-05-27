<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Student;

use App\Events\Student\CustomQuizWarning;
use App\Mail\StudentQuizMessage;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Message extends Component
{

    public Quiz $quiz;
    public User $student;
    public $message_method = 'email';
    public $email = '';
    public $message_subject = '';
    public $message_content = '';


    public function mount(Quiz $quiz, User $student)
    {
        $this->quiz = $quiz;
        $this->student = $student;
        $this->email = $this->student->email;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student.message');
    }

    public function send()
    {
        if ($this->message_method == "email") {
            $this->sendEmail();
        } else {
            $this->sendInAppNotification();
        }

        $this->emit('closeWindow');
    }

    public function sendEmail()
    {
        Mail::to($this->email)->send(new StudentQuizMessage($this->message_subject, $this->message_content));
    }

    public function sendInAppNotification()
    {
        event(new CustomQuizWarning($this->quiz, $this->student, $this->message_content));
    }
}
