<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // show all courses
    public function index()
    {
        return view('student.course.index', ['courses' => auth()->user()->courses]);
    }

    // show course
    public function show(Course $course)
    {
        $course->load(['quizzes', 'teacher', 'sections.lessons']);

        return view('student.course.show', compact('course'));
    }
}
