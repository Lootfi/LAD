<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // show one quiz method
    public function show(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions.answers', 'course']);

        //sort quiz questions by created_at
        $quiz->questions = $quiz->questions->sortBy('created_at', descending: true);

        return view('student.quiz.show', compact('quiz'));
    }

    // index method
    public function index(Course $course)
    {
        $course->load('quizzes');

        $upcoming = $course->quizzes->filter(function ($model) {
            return $model->status == 'upcoming';
        });
        $closed = $course->quizzes->filter(function ($model) {
            return $model->status == 'closed';
        });
        $active = $course->quizzes->filter(function ($model) {
            return $model->status == 'active';
        });

        $quizzes = [
            'upcoming' => $upcoming,
            'closed' => $closed,
            'active' => $active,
        ];

        return view('student.quiz.index', ['course' => $course, 'quizzes' => $quizzes]);
    }

    public function results(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions.answers', 'course', 'questions.responses']);

        $quiz->questions = $quiz->questions->sortBy('created_at', descending: true);

        $quiz->questions->each(function ($question) {
            $question->correct = false;
            $responses = $question->responses()->where('student_id', auth()->id())->get();

            foreach ($responses as $response) {
                if ($response->answer->is_right) {
                    $question->correct = true;
                } else {
                    $question->correct = false;
                    break;
                }
            }
        });


        return view('student.quiz.results', compact('course', 'quiz'));
    }
}
