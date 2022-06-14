<?php

namespace App\View\Components\teacher\quiz;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\View\Component;

class create_new_question_modal extends Component
{
    // quiz and question parameters
    public $course;

    public $quiz;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.teacher.quiz.create_new_question_modal');
    }
}
