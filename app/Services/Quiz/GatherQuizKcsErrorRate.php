<?php

namespace App\Services\Quiz;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;

class GatherQuizKcsErrorRate
{

    public function __invoke(Quiz $quiz, Kc $kc)
    {
        $data = $this->getKcErrorRate($quiz, $kc);
        return $data;
    }

    public function getKcErrorRate(Quiz $quiz, Kc $kc)
    {
        $error_count = 0;
        $resp_count = 0;

        $questionsData = [];
        foreach ($kc->questions()->where('quiz_id', $quiz->id)->get() as $question) {
            $gatherQuestionErrorRate = new GatherQuizQuestionsErrorRate;
            $questionData = $gatherQuestionErrorRate($quiz, $question);
            array_push($questionsData, $questionData);
        }

        foreach ($questionsData as $questionData) {
            $error_count += $questionData['error_count'];
            $resp_count += $questionData['resp_count'];
        }

        if ($resp_count == 0) {
            return [
                'error_rate' => 0,
                'error_count' => $error_count,
                'resp_count' => $resp_count,
            ];
        } else {
            return [
                'error_rate' => $error_count / $resp_count,
                'error_count' => $error_count,
                'resp_count' => $resp_count,
            ];
        }
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

            if ($correctAsnwers->diff($studentResponseAnswers)->isEmpty() && $studentResponseAnswers->diff($correctAsnwers)->isEmpty()) {
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
