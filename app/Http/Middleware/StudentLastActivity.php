<?php

namespace App\Http\Middleware;

use App\Events\Student\ViewCourse;
use App\Events\Student\ViewLesson;
use App\Events\StudentOnline;
use App\Models\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

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
        Cache::put('is_online_'.$user->id, true, $expireTime);
        $user = User::whereId($user->id)->first();
        $user->update(['last_seen' => Carbon::now()]);

        // websockets event
        event(new StudentOnline($user));

        return $next($request);
    }
}
