<?php

namespace App\Http\Middleware;

use App\Events\Student\ViewCourse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use Carbon\Carbon;

class StudentLastActivity
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


        $user = auth()->user();
        $expireTime = Carbon::now()->addSeconds(30);
        Cache::put('is_online_' . $user->id, true, $expireTime);
        $user = User::whereId($user->id)->update(['last_seen' => Carbon::now()]);

        // check if request method is GET
        if ($request->isMethod('GET')) {
            // request route name
            $routeName = $request->route()->getName();
            // if route name is student.course.show (student course show page)
            if ($routeName == 'student.course.show') {
                $this->logViewCourse($request);
            }
        } elseif ($request->isMethod('POST')) {
        } elseif ($request->isMethod('PUT')) {
        }

        return $next($request);
    }

    /*
    * logViewCourse
    *
    */
    public function logViewCourse(Request $request)
    {
        event(new ViewCourse(request()->user(), $request->route('course')));
    }
}
