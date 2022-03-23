<?php

namespace App\Http\Controllers;

use App\Models\QuizStudents;
use App\Http\Requests\StoreQuizStudentsRequest;
use App\Http\Requests\UpdateQuizStudentsRequest;

class QuizStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuizStudentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizStudentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizStudents  $quizStudents
     * @return \Illuminate\Http\Response
     */
    public function show(QuizStudents $quizStudents)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizStudents  $quizStudents
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizStudents $quizStudents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuizStudentsRequest  $request
     * @param  \App\Models\QuizStudents  $quizStudents
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizStudentsRequest $request, QuizStudents $quizStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizStudents  $quizStudents
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizStudents $quizStudents)
    {
        //
    }
}
