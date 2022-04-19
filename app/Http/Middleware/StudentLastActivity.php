<?php

namespace App\Http\Middleware;

use App\Events\Student\ViewCourse;
use App\Events\Student\ViewLesson;
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

        return $next($request);
    }
}
