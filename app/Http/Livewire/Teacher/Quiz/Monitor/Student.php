<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizStudent;
use App\Models\User;
use Livewire\Component;

class Student extends Component
{

    public $student;
    public $quiz;
    public $quiz_student;

    public function mount(Quiz $quiz, User $student)
    {
        $this->quiz = $quiz;
        $this->student = $student;
        $this->quiz_student = QuizStudent::query()
            ->where('quiz_id', $this->quiz->id)
            ->where('student_id', $student->id)
            ->first();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student');
    }
}
