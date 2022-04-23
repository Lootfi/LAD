<?php

namespace App\View\Components\teacher\quiz;

use App\Models\QuizQuestion;
use Illuminate\View\Component;

class edit_kcs_form extends Component
{
    // params
    public $question;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(QuizQuestion $question)
    {
        $this->question = $question->load(['kcqs.kc', 'quiz.course']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teacher.quiz.edit_kcs_form');
    }
}
