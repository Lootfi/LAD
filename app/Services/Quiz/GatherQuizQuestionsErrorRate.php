<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use Illuminate\Database\Eloquent\Collection;

class GatherQuizQuestionsErrorRate
{

    public function __invoke(Quiz $quiz, QuizQuestion $question)
    {

        // load kcs and responses and and answers

        $kcs = $question->load(['kcs', 'responses.answer']);

        // we have a bar graph where y = knoledge components related to the question and x = error rate of the question
        // we need to get the knoledge components related to the question
        // we need to get the error rate of the question

        // get the knoledge components related to the question
        $kcs = $question->kcs;

        // get error rate for each kc
        $data = $this->getQuestionErrorRates($question);


        return $data;
    }

    public function getQuestionErrorRates(QuizQuestion $question)
    {

        $responses = $question->responses->groupBy('student_id');
        $resp_count = $responses->count();
        $err_count = 0;

        $data = [];


        if ($resp_count == 0) {
            $data = [
                'error_rate' => 0,
                'error_count' => $err_count,
                'resp_count' => $resp_count,
            ];
            return $data;
        }

        $studentsWhoAnswered = $question->responses()->with('student')->get()->pluck('student')->unique();

        $correctAsnwers = $question->answers()->where('right_answer', true)->get();

        foreach ($studentsWhoAnswered as $student) {
            $studentResponseAnswers = QuizResponse::query()
                ->where('student_id', $student->id)
                ->where('question_id', $question->id)
                ->with('answer')
                ->get()
                ->pluck('answer');

            if ($correctAsnwers->diff($studentResponseAnswers)->isNotEmpty()) {
                $err_count++;
            }
        }


        $data = [
            'error_rate' => $err_count / $resp_count,
            'error_count' => $err_count,
            'resp_count' => $resp_count,
        ];

        return $data;
    }
}
