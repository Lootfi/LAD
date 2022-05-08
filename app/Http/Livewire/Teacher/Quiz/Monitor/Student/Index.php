<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Student;

use App\Models\Quiz;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $student;
    public $quiz;

    public function mount(User $student, Quiz $quiz)
    {
        $this->student = $student;
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student.index');
    }
}
