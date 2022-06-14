<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\KCQ;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;

class QuizQuestionController extends Controller
{
    public function update(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        $course = $quiz->course;
        $quiz->load('questions');

        //update question
        $question = $quiz->questions->find($question);
        $question->update([
            'question' => $request->question,
        ]);

        // update answers
        $answers = $question->answers;

        $answers->each(function ($answer) use ($request) {
            $answer->update([
                'answer' => $request->answers[$answer->id],
                'right_answer' => in_array($answer->id, $request->get('right-answers')),
            ]);
            $answer->save();
        });

        //update kcqs
        $question->kcs()->sync($request->kcs);

        $question->save();

        //reload page and scroll to the updated question in the list of questions in the quiz edit page
        return redirect()->route('teacher.quiz.edit', ['course' => $course, 'quiz' => $quiz, 'question_id' => $question->id]);
    }

    // store question in quiz and redirect to edit page of the question in the quiz edit page
    // create with it one answer
    public function store(Request $request, Quiz $quiz)
    {
        $course = $quiz->course;
        $quiz->load('questions');

        $question = $quiz->questions()->create([
            'question' => $request->question,
            'order' => $quiz->questions->count() + 1,
        ]);
        $question->answers()->create([
            'answer' => $request->answer,
            'right_answer' => true,
        ]);

        $question->kcs()->attach($request->kcs);
        $question->save();

        return redirect()->route('teacher.quiz.edit', ['course' => $course, 'quiz' => $quiz, 'question_id' => $question->id]);
    }
}
