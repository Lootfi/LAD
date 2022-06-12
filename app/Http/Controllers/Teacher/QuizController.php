<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use QuizFacade;

class QuizController extends Controller
{

    public function index(Course $course)
    {
        return view('teacher.quiz.index', ['course' => $course->load('quizzes')]);
    }

    public function create(Course $course)
    {
        return view('teacher.quiz.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $quiz = $course->quizzes()->create($request->all());

        return redirect()->route('teacher.quiz.index', compact('course'));
    }

    public function show(Course $course, Quiz $quiz)
    {
        if ($quiz->status == "active") {
            $quiz->pass_percentage = "Still Active";
        } elseif ($quiz->status == "upcoming") {
            $quiz->pass_percentage = "Not Yet";
        } else {
            $quiz->pass_percentage = QuizFacade::getPassPercentage($quiz) * 100 . '%';
        }

        return view('teacher.quiz.show', compact('course', 'quiz'));
    }

    public function edit(Course $course, Quiz $quiz)
    {
        if ($quiz->is_active) {
            return redirect()->route('teacher.quiz.show', [
                'course' => $course,
                'quiz' => $quiz
            ]);
        } else {
            $quiz->load('questions.answers');
            return view('teacher.quiz.edit', compact('course', 'quiz'));
        }
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

    public function notify(Course $course, Quiz $quiz)
    {
        $students = $course->students;

        foreach ($students as $student) {
            // send the student a notification
            $student->notify(new \App\Notifications\NewQuiz($quiz->load('course')));
        }

        return redirect()->route('teacher.quiz.index', compact('course'))->with('success', 'Students have been notified about quiz!');
    }

    public function message(Course $course, Quiz $quiz, User $student)
    {
        return view('teacher.quiz.monitor.message', [
            'course' => $course,
            'quiz' => $quiz,
            'student' => $student
        ]);
    }

    public function sort(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions', 'course']);

        return view('teacher.quiz.sort-questions', ['quiz' => $quiz, 'course' => $course]);
    }

    public function monitor(Course $course, Quiz $quiz)
    {
        return view('teacher.quiz.monitor.index', [
            'quiz' => $quiz->load(['questions.kcs']),
            'course' => $course->load('students')
        ]);
    }

    public function monitorStudent(Course $course, Quiz $quiz, User $student)
    {
        return view('teacher.quiz.monitor.student', [
            'quiz' => $quiz->load('questions'),
            'course' => $course,
            'student' => $student
        ]);
    }
}
