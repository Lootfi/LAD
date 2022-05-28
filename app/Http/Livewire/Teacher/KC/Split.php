<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Course;
use App\Models\Kc;
use App\Models\KCL;
use App\Models\KCQ;
use Livewire\Component;

class Split extends Component
{
    public Course $course;
    public int $current_step = 1;
    public Kc $kc;
    public $questions;
    public $lessons;
    public int $splitnum = 2;
    public $splits = [];
    public $lessons_kcs = [];
    public $questions_kcs = [];

    public $new_kcs;

    protected $rules = [
        'splitnum' => 'required|numeric|integer|min:2|max:3',
        'splits.*' => 'required|distinct|string|min:6|max:30|unique:kcs,name',
        'lessons_kcs.*' => 'required|array',
        'questions_kcs.*' => 'required|array',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Course $course, Kc $kc, $questions, $lessons)
    {
        $this->course = $course;
        $this->kc = $kc;
        $this->questions = $questions;
        $this->lessons = $lessons;
    }

    public function render()
    {
        return view('livewire.teacher.kc.split');
    }

    public function goNext()
    {
        $this->validate();
        switch ($this->current_step) {
            case 1:
                $this->finishFirstStep();
                break;
            case 2:
                $this->finishSecondStep();
                break;
            case 3:
                $this->finishThirdStep();
                break;
            case 4:
                $this->finishFourthStep();
                break;
        }
        $this->current_step++;
    }

    public function finishFirstStep()
    {
        $this->setupForSecondStep();
    }

    public function setupForSecondStep()
    {
        for ($i=1; $i <= $this->splitnum; $i++) { 
            if(!isset($this->splits[$i])) {
                $this->splits[$i] = "";
            }
        }
    }

    public function finishSecondStep()
    {
        $this->setupForThirdStep();
    }

    public function setupForThirdStep()
    {
        foreach ($this->lessons as $lesson) {
            $this->lessons_kcs[$lesson->id] = [];
        }
    }

    public function finishThirdStep()
    {
        $this->setupForFourthStep();
    }

    public function setupForFourthStep()
    {
        foreach ($this->questions as $question) {
            $this->questions_kcs[$question->id] = [];
        }
    }

    public function finishFourthStep()
    {
        $this->save();
    }

    public function save()
    {
        $this->new_kcs = $this->createNewKcs();

        $this->assignNewKcsToLessons();

        $this->assignNewKcsToQuestions();

        $this->deleteOldKc();
    }

    public function createNewKcs()
    {
        $new_kcs = collect();
        foreach ($this->splits as $split) {
            $new_kcs->push(Kc::query()
            ->create([
                'name' => $split,
                'description' => $split,
                'course_id' => $this->course->id
            ]));
        }

        return $new_kcs;
    }

    public function assignNewKcsToLessons()
    {
        foreach ($this->lessons as $lesson) {
            $lkcs = $this->lessons_kcs[$lesson->id];

            foreach ($lkcs as $lkc) {
                $kc = Kc::query()->where('name', $lkc)->first();

                KCL::query()->create([
                    'kc_id' => $kc->id,
                    'lesson_id' => $lesson->id
                ]);
            }
        }
    }

    public function assignNewKcsToQuestions()
    {
        foreach ($this->questions as $question) {
            $qkcs = $this->questions_kcs[$question->id];

            foreach ($qkcs as $qkc) {
                $kc = Kc::query()->where('name', $qkc)->first();

                KCQ::query()->create([
                    'kc_id' => $kc->id,
                    'question_id' => $question->id
                ]);
            }
        }
    }

    public function deleteOldKc()
    {
        $this->kc->delete();
    }
}
