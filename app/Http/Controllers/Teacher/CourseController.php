<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Kc;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load(['sections.lessons', 'students']);

        return view('teacher.course.show', compact('course'));
    }
}
