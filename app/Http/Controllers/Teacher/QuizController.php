<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // create quiz function
    public function create()
    {
        // get the authenticated user's course
        $course = auth()->user()->course;
        // get the authenticated user's course's quiz
        return view('teacher.quiz.create', compact('course'));
    }

    // index quiz function
    public function index()
    {

        $heads = [
            'Quiz',
            ['label' => 'Start Date',],
            ['label' => 'Status',],
            ['label' => 'Active Students', 'no-export' => true],
            ['label' => 'Completion', 'no-export' => true],
            ['label' => '', 'width' => '1', 'no-export' => true],
        ];

        $config = [
            'filters' => ['quiz_name', 'start_date', 'status'],
            'actions' => ['edit', 'delete'],
            'perPage' => 10,
            'perPageOptions' => [10, 20, 50, 100],
            'order' => [['start_date', 'desc']],
            'columns' => ['quiz_name', 'start_date', 'status', 'students', 'completion', 'actions'],
        ];
        // get the authenticated user's course with quizzes relation eager loaded 
        $course = auth()->user()->teaches()->with('quizzes')->first();
        // get the authenticated user's course's quiz
        return view('teacher.quiz.index', compact('course', 'heads', 'config'));
    }

    // store quiz function
    public function store(Request $request)
    {
        // get the authenticated user's course
        $course = auth()->user()->course;
        // create a new quiz
        $quiz = $course->quizzes()->create($request->all());
        // redirect to the quiz index page
        return redirect()->route('teacher.quiz.index');
    }

    // show quiz function
    public function show(Course $course, Quiz $quiz)
    {
        return view('teacher.quiz.show', compact('course', 'quiz'));
    }

    // edit quiz function
    public function edit(Course $course, Quiz $quiz)
    {
        // get quiz questions and answers with quiz_question and quiz_answer relation eager loaded
        $quiz = $quiz->load('questions.answers');
        // return the edit quiz page
        return view('teacher.quiz.edit', compact('course', 'quiz'));
    }

    // update quiz function
    public function update(Request $request, Course $course, Quiz $quiz)
    {
        $quiz->update($request->all());
        // redirect to the quiz index page
        return redirect()->route('teacher.quiz.index', $course);
    }

    // destroy quiz function
    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();
        // redirect to the quiz index page
        return redirect()->route('teacher.quiz.index');
    }

    // show quiz result function

}
