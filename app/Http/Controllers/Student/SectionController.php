<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //index
    public function index(Course $course)
    {
        return view('student.section.index', ['course' => $course->load('sections')]);
    }
}
