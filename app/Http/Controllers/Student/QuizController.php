<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // show one quiz method
    public function show(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions.answers', 'course']);

        return view('student.quiz.show', compact('quiz'));
    }
}
