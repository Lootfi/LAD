<?php

namespace App\Http\Livewire\Student;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;

class QuizComponent extends Component
{

    public Quiz $quiz;
    public QuizQuestion $active_question;

    public $listeners = [
        'nextQuestion' => 'nextQuestion',
    ];

    public function nextQuestion($current_step)
    {
        $this->active_question = $this->quiz->questions[$current_step + 1];
    }

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.answers');
        $this->active_question = $this->quiz->questions->first();
    }


    public function render()
    {
        return view('livewire.student.quiz-component');
    }
}
