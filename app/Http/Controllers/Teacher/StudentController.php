<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //index function
    public function index()
    {
        return view('teacher.students');
    }

    public function manage(Course $course)
    {
        return view('teacher.course.students', compact('course'));
    }

    public function import(Course $course)
    {
        return view('teacher.student.import', compact('course'));
    }
}
