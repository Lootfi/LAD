<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // create quiz function
    public function create(Course $course)
    {
        return view('teacher.quiz.create', compact('course'));
    }

    // index quiz function
    public function index()
    {

        // load the authenticated user's course quizzes
        $course = auth()->user()->teaches()->with('quizzes')->first();

        $heads = [
            ['label' => 'Name', 'key' => 'name'],
            ['label' => 'Start Date', 'key' => 'start_date'],
            ['label' => 'Status', 'key' => 'status'],
            ['label' => 'Active Students', 'no-export' => true, 'key' => 'active_students'],
            ['label' => 'Completion', 'no-export' => true, 'key' => 'completion'],
            ['label' => 'Actions', 'width' => '1', 'no-export' => true, 'key' => 'actions'],
        ];

        $config = [
            //filters
            'filters' => [
                ['name' => 'name', 'label' => 'Name', 'type' => 'text'],
                ['name' => 'start_date', 'label' => 'Start Date', 'type' => 'date'],
                ['name' => 'status', 'label' => 'Status', 'type' => 'select', 'options' => [
                    ['value' => '', 'label' => 'All'],
                    ['value' => 'active', 'label' => 'Active'],
                    ['value' => 'inactive', 'label' => 'Inactive'],
                ]],
            ],
            'actions' => ['edit', 'delete'],
            'perPage' => 10,
            'perPageOptions' => [10, 20, 50, 100],
            'order' => [['start_date', 'desc']],
            //columns
            'columns' => $heads,
        ];

        return view('teacher.quiz.index', compact('course', 'heads', 'config'));
    }

    // store quiz function
    public function store(Request $request)
    {
        // get the authenticated user's course
        $course = auth()->user()->teaches;
        // create a new quiz
        $quiz = $course->quizzes()->create($request->all());
        // redirect to the quiz index page
        return redirect()->route('teacher.quiz.index', compact('course'));
    }

    // show quiz function
    public function show(Course $course, Quiz $quiz)
    {
        return view('teacher.quiz.show', compact('course', 'quiz'));
    }

    // edit quiz function
    public function edit(Course $course, Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('teacher.quiz.edit', compact('course', 'quiz'));
    }

    public function update(Request $request, Course $course, Quiz $quiz)
    {
        $quiz->update($request->all());
        return redirect()->route('teacher.quiz.index', $course);
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('teacher.quiz.index', ['course' => $course]);
    }

    // notify quiz function
    public function notify(Course $course, Quiz $quiz)
    {
        // get the quiz's students
        $students = $course->students;

        // loop through the students
        foreach ($students as $student) {
            // send the student a notification
            $student->notify(new \App\Notifications\NewQuiz($quiz->load('course')));
        }

        return redirect()->route('teacher.quiz.index', compact('course'))->with('success', 'Students have been notified about quiz!');
    }

    //sort quiz questions function
    public function sort(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions', 'course']);
        return view('teacher.quiz.sort-questions', ['quiz' => $quiz, 'course' => $course]);
    }
}
