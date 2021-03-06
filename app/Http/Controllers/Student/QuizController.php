<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use QuizFacade;

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
        $quiz->load(['questions.answers', 'course', 'questions']);

        $score = $quiz->students()->where('student_id', auth()->id())->first()->score;

        $quiz->questions->each(function ($question) {
            $question->my_responses = $question
                ->responses()
                ->where('student_id', auth()->user()->id)
                ->get();
        });
        $quiz->questions = $quiz->questions->sortBy('created_at', descending: true);

        $correct = [];

        foreach ($quiz->questions as $question) {
            $correct[$question->id] = QuizFacade::getQuestionCorrectness(auth()->user(), $question);
        }

        //building responses array ['question_id' => ['answer_id' => ['answered' => true, 'correct' => true]]]
        $responses = [];

        foreach ($quiz->questions as $question) {
            foreach ($question->answers as $answer) {
                $answered = $question->my_responses->contains('answer_id', $answer->id);
                $responses[$question->id][$answer->id]['answered'] = $answered;
                if ($answered && $answer->right_answer) {
                    $responses[$question->id][$answer->id]['correct'] = true;
                } else {
                    $responses[$question->id][$answer->id]['correct'] = false;
                }
            }
        }

        return view('student.quiz.results', compact('course', 'quiz', 'correct', 'responses', 'score'));
    }
}
