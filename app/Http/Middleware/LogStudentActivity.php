<?php

namespace App\Http\Middleware;

use App\Events\Student\ViewCourse;
use App\Events\Student\ViewLesson;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Cache;
use Carbon\Carbon;

class LogStudentActivity
{
    public $params;
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
        $method = $request->method();

        if ($routeName == 'student.course.show') {
            $this->logViewCourse($request);
        } elseif ($routeName == 'student.course.section.lesson.show') {
            $this->logViewLesson($request);
        }

        return $next($request);
    }


    /*
    * logViewCourse
    *
    */
    public function logViewCourse(Request $request)
    {
        $course = Course::find($request->route('course'))->first();
        event(new ViewCourse(request()->user(), $course));
    }

    /*
    * logViewLesson
    *
    */
    public function logViewLesson(Request $request)
    {
        $lesson = Lesson::find($request->route('lesson'))->first();
        event(new ViewLesson(request()->user(), $lesson));
    }
}
