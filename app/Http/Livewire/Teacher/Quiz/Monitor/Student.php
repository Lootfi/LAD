<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use Livewire\Component;

class Student extends Component
{

    public $student;
    public $quiz;
    public $selectedQuestion;

    protected $listeners = [
        'chooseQuestion' => 'chooseQuestion',
    ];

    public function mount(Quiz $quiz, User $student)
    {
        $this->quiz = $quiz;
        $this->student = $student;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student');
    }

    public function chooseQuestion(QuizQuestion $question, User $student)
    {
    }
}
