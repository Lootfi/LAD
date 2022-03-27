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
        $quiz = $quiz->load('questions');
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

        return redirect()->route('teacher.quiz.show', parameters: ['course' => $course, 'quiz' => $quiz]);
    }
}
