<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Kc;
use Illuminate\Http\Request;

class KCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    // public function index(Course $course)
    // {
    //     return view('teacher.kc.index', [
    //         'course' => $course->load('kcs'),
    //     ]);
    // }

    /**
     * Show the form for creating and editing course knowledge components.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage(Course $course)
    {
        return view('teacher.kc.manage', [
            'course' => $course->load('kcs'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, Course $course)
    {

        $kc = new Kc();
        $kc->name = $request->name;
        $kc->description = $request->description;
        $kc->course_id = $course->id;
        $kc->save();

        return redirect()->route('teacher.kc.manage', [
            'course' => $course->load('kcs'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kc  $kc
     */
    public function show(Course $course, Kc $kc)
    {
        // TODO
        // we can show all related resources of this kc, [lessons, questions, quizzes, assignments, etc]
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kc  $kc
     */
    public function update(Request $request, Course $course, Kc $kc)
    {

        $kc->name = $request->name;
        $kc->description = $request->description;
        $kc->save();

        return redirect()->route('teacher.kc.manage', [
            'course' => $course->load('kcs'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kc  $kc
     */
    public function destroy(Course $course, Kc $kc)
    {
        $kc->delete();

        return redirect()->route('teacher.kc.manage', [
            'course' => $course->load('kcs'),
        ]);
    }
}
