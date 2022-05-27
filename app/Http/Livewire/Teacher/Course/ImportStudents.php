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
    public $errors;
    public $duplicates;

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

        $import = new StudentsImport();
        $import->import($this->students_file);

        $this->errors = $import->errors();
        $duplicates = collect();
        foreach ($this->errors as $error) {
            if($error->getCode() == 23000) {
                $duplicates->push($error->errorInfo[2]);
            }
        }

        $this->duplicates = $duplicates;
        
        session()->flash('success', 'Students successfully uploaded.');
    }

    public function render()
    {
        return view('livewire.teacher.course.import-students');
    }
}
