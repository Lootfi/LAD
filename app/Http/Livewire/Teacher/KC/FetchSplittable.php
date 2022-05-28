<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Course;
use App\Models\QuizQuestion;
use App\Services\Course\FetchSplittableKcs;
use App\Services\Quiz\GatherQuizQuestionsErrorRate;
use Livewire\Component;

class FetchSplittable extends Component
{

    public Course $course;
    public $grouped_questions;
    public $split_percentage = 0.5;
    public $splittable;
    public $question_groups_er_differences;

    protected $rules = [
        'split_percentage' => 'required|numeric|between:0.1,0.99',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.teacher.kc.fetch-splittable');
    }

    public function fetchSplittable()
    {
        $validatedData = $this->validate();

        $fetchSplittable = new FetchSplittableKcs;

        $this->question_groups_er_diffs = $fetchSplittable($this->course, $this->split_percentage);
    }
}
