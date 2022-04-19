<?php

namespace App\Http\Livewire\Teacher\Course\Cards;

use Livewire\Component;

class StudentsOnline extends Component
{
    public $course;
    public $students;

    public function mount()
    {
        $this->course = auth()->user()->teaches;
        $this->students = $this->getStudentsOnline();
    }

    public function render()
    {
        return view('livewire.teacher.course.cards.students-online');
    }

    public function getStudentsOnline()
    {
        $students = collect();

        foreach ($this->course->students as  $student) {
            if ($student->isOnline()) {
                $students->push($student);
            }
        }

        return $students;
    }
}
