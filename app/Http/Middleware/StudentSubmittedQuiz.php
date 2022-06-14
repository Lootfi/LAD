<?php

namespace App\Http\Middleware;

use App\Models\Quiz;
use App\Models\QuizStudent;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class StudentSubmittedQuiz
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();

        if ($routeName == 'student.quiz.show') {
            $quiz = Quiz::whereId($request->route('quiz')->id)->first();
            $quizStudentSubmitted = QuizStudent::query()
                ->where('quiz_id', $quiz->id)
                ->where('student_id', auth()->user()->id)
                ->where('submitted', true)
                ->first();
            if ($quizStudentSubmitted || $quiz->status == 'closed') {
                return redirect()->route('student.quiz.results', ['course' => $quiz->course, 'quiz' => $quiz]);
            }
        } elseif ($routeName == 'student.quiz.results') {
            $quiz = Quiz::whereId($request->route('quiz')->id)->first();
            $quizStudentSubmitted = QuizStudent::query()
                ->where('quiz_id', $quiz->id)
                ->where('student_id', auth()->user()->id)
                ->where('submitted', true)
                ->first();
            if ($quizStudentSubmitted == null && $quiz->status != 'closed') {
                return redirect()->route('student.quiz.show', ['course' => $quiz->course, 'quiz' => $quiz]);
            }
        }

        return $next($request);
    }
}
