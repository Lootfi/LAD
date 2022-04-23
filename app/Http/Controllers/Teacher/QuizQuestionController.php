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
                'right_answer' => in_array($answer->id, $request->get("right-answers")),
            ]);
            $answer->save();
        });

        //update kcqs
        $kcqs = $question->kcqs;

        //if q_kcs array is empty, delete all kcqs
        if (empty($request->q_kcs)) {
            $kcqs->each(function ($kcq) {
                KCQ::query()
                    ->where('kc_id', $kcq->kc_id)
                    ->where('question_id', $kcq->question_id)
                    ->delete();
            });
        } else {
            // find if user deleted kcqs
            $kcqs->each(function ($kcq) use ($request) {
                if (!in_array($kcq->kc_id, $request->get("q_kcs"))) {
                    KCQ::query()
                        ->where('kc_id', $kcq->kc_id)
                        ->where('question_id', $kcq->question_id)
                        ->delete();
                }
            });

            // find if user added kcqs
            foreach ($request->get('q_kcs') as $kc_id) {
                if (!$question->kcqs->contains('kc_id', $kc_id)) {
                    KCQ::query()
                        ->create([
                            'question_id' => $question->id,
                            'kc_id' => $kc_id,
                        ]);
                }
            }
        }
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
        $question->save();

        return redirect()->route('teacher.quiz.edit', ['course' => $course, 'quiz' => $quiz, 'question_id' => $question->id]);
    }
}
