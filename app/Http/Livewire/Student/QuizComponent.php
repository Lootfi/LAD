<?php

namespace App\Http\Livewire\Student;

use App\Models\Quiz;
use Livewire\Component;

class QuizComponent extends Component
{

    public $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }


    public function render()
    {
        return view('livewire.student.quiz-component');
    }
}
