<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public Course $course;
    public Quiz $quiz;

    protected $listeners = [
        'chooseQuestion' => 'chooseQuestion',
    ];

    public function mount(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.index');
    }

    public function chooseQuestion(QuizQuestion $question, User $student)
    {
    }
}
