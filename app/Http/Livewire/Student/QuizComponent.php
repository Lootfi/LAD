<?php

namespace App\Http\Livewire\Student;

use App\Models\Quiz;
use Livewire\Component;

class QuizComponent extends Component
{

    public $quiz;
    public $active_question;

    public $listeners = [
        'nextQuestion' => 'nextQuestion',
    ];

    public function nextQuestion($current_step)
    {
        $this->active_question = $current_step + 1;
        dd($this->active_question);
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
