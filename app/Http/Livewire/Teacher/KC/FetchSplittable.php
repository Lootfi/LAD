<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Course;
use KcFacade;
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
        $this->validate();

        $this->question_groups_er_diffs = KcFacade::fetchSplittable($this->course, $this->split_percentage);
    }
}
