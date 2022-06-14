<?php

namespace App\View\Components\student\quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class active_quizzes extends Component
{
    // quiz and question parameters
    public $quizzes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $quizzes)
    {
        $this->quizzes = $quizzes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student.quiz.active_quizzes');
    }
}
