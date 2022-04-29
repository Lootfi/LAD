<?php

namespace App\Http\Livewire\Teacher\Course\Cards;

use App\Models\User;
use Livewire\Component;

class StudentsOnline extends Component
{
    public $course;
    public $students;

    protected $listeners = [
        'echo:studentonline,StudentOnline' => 'updateStudents'
    ];

    public function mount()
    {
        $this->course = auth()->user()->teaches;
    }

    public function render()
    {
        $this->students = $this->getStudentsOnline();
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

    public function updateStudents(array $params)
    {
        $this->students->push(User::query()->find($params['student']['id']));
    }
}
