<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\KnowledgeComponent;
use Illuminate\Http\Request;

class KCController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        return view('teacher.kc.index', [
            'course' => $course->load('kcs'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('teacher.kc.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KnowledgeComponent  $knowledgeComponent
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, KnowledgeComponent $knowledgeComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KnowledgeComponent  $knowledgeComponent
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, KnowledgeComponent $knowledgeComponent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KnowledgeComponent  $knowledgeComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, KnowledgeComponent $knowledgeComponent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KnowledgeComponent  $knowledgeComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, KnowledgeComponent $knowledgeComponent)
    {
        //
    }
}
