<?php

namespace App\View\Components\teacher\quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\View\Component;

class edit_question_form extends Component
{
    // params
    public $quiz;

    public $question;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz, QuizQuestion $question)
    {
        $this->quiz = $quiz;
        $this->question = $question;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teacher.quiz.edit_question_form');
    }
}
