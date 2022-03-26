<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $students = $course->students;
        $quizzes = $course->quizzes;

        return view('teacher.course', compact('course', 'students', 'quizzes'));
    }
}
