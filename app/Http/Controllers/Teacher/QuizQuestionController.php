<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
        $question = $quiz->questions->find($question);
        $question->update([
            'question' => $request->question,
        ]);
        $answers = $question->answers;

        $answers->each(function ($answer) use ($request) {
            $answer->update([
                'answer' => $request->answers[$answer->id],
                'right_answer' => in_array($answer->id, $request->get("right-answers")),
            ]);
            $answer->save();
        });
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
        ]);
        $question->answers()->create([
            'answer' => $request->answer,
            'right_answer' => true,
        ]);
        $question->save();

        //reload page and scroll to the new question in the list of questions in the quiz edit page
        return redirect()->route('teacher.quiz.edit', ['course' => $course, 'quiz' => $quiz, 'question_id' => $question->id]);
    }
}
