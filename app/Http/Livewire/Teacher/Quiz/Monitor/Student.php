<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Quiz;
use App\Models\User;
use Livewire\Component;

class Student extends Component
{

    public $student;
    public $quiz;

    public function mount(Quiz $quiz, User $student)
    {
        $this->quiz = $quiz;
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student');
    }
}
