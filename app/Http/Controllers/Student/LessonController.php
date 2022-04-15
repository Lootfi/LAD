<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // show lesson
    public function show(Course $course, Section $section, Lesson $lesson)
    {
        return view('student.lesson.show', compact('course', 'section', 'lesson'));
    }
}
