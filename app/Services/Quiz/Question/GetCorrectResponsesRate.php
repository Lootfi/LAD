<?php

namespace App\Services\Quiz\Question;

use App\Models\QuizQuestion;
use App\Services\Quiz\GatherQuizQuestionsErrorRate;

class GetCorrectResponsesRate
{

    public function __invoke(QuizQuestion $question)
    {
        $gatherErrorRate = new GatherQuizQuestionsErrorRate;

        $errorRateData = $gatherErrorRate($question);

        return ($errorRateData['resp_count'] - $errorRateData['error_count']) / $question->quiz->course->students->count();
    }
}
