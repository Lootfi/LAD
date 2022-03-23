<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Http\Requests\StoreQuizAnswerRequest;
use App\Http\Requests\UpdateQuizAnswerRequest;

class QuizAnswerController extends Controller
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
     * @param  \App\Http\Requests\StoreQuizAnswerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizAnswerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuizAnswerRequest  $request
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizAnswerRequest $request, QuizAnswer $quizAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizAnswer  $quizAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizAnswer $quizAnswer)
    {
        //
    }
}
