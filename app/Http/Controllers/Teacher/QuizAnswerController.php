<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    // store new quiz answer function
    public function store(Request $request, Course $course, Quiz $quiz, QuizQuestion $question)
    {
        $course = $quiz->course;
        $question->answers()->create([
            'answer' => $request->answer,
            'right_answer' => $request->right_answer ? true : false,
        ]);
        return redirect()->route('teacher.quiz.show', parameters: ['course' => $course, 'quiz' => $quiz]);
    }
}
