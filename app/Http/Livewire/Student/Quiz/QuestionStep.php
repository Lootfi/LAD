<?php

namespace App\Http\Livewire\Student\Quiz;

use App\Models\QuizQuestion;
use Livewire\Component;

class QuestionStep extends Component
{
    public $question;
    public $step;
    public $quiz;
    public $responses = [];

    public function mount(QuizQuestion $question, $step)
    {
        $this->step = $step;

        $this->question = $question;
        $this->quiz = $this->question->quiz;
    }

    // goToNextQuestion EVENT
    public function goToNextQuestion()
    {
        $this->saveResponses();
        $this->emitUp('nextQuestion', $this->step);
    }

    //saving student's response in database
    public function saveResponses()
    {
    }


    public function render()
    {
        return view('livewire.student.quiz.question-step');
    }
}
