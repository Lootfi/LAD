<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Course;
use App\Models\Quiz;
use Livewire\Component;

class Index extends Component
{

    public Course $course;
    public Quiz $quiz;

    public function mount(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.index');
    }
}