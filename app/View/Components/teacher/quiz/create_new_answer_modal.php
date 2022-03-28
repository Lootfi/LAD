<?php

namespace App\View\Components\teacher\quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\View\Component;

class create_new_answer_modal extends Component
{
    // quiz and question parameters
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
        return view('components.teacher.quiz.create_new_answer_modal');
    }
}
