<?php

namespace App\View\Components\teacher\quiz;

use App\Models\QuizAnswer;
use Illuminate\View\Component;

class edit_answer_form extends Component
{
    // params
    public $answer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(QuizAnswer $answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teacher.quiz.edit_answer_form');
    }
}
