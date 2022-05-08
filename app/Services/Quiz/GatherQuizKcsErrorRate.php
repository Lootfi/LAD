<?php

namespace App\Services\Quiz;

use App\Models\Kc;
use App\Models\Quiz;

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
            $questionData = $gatherQuestionErrorRate($question);
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
}
