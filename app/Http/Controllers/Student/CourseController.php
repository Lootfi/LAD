<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // show course
    public function show(Course $course)
    {
        $course->load(['quizzes', 'students']);
        return view('student.course.show', compact('course'));
    }
}
