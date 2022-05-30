<?php

namespace App\Http\Livewire\Teacher\Course;

use App\Imports\StudentsImport;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudents extends Component
{
    use WithFileUploads;

    public Course $course;
    public $students_file;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function save()
    {
        $this->validate([
            'students_file' => 'required|mimes:csv,txt,xlsx'
        ]);

        $this->students_file->storeAs('students_csv', 'students_course-' . $this->course->id . '_' . date('m-d-Y_hia'));

        $import = new StudentsImport($this->course);
        $import->import($this->students_file);

        session()->flash('success', 'Students successfully uploaded.');
    }

    public function render()
    {
        return view('livewire.teacher.course.import-students');
    }
}
