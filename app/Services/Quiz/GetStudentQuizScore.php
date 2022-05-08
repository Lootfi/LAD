<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\User;

class GetStudentQuizScore
{

    // invoke
    public function __invoke(Quiz $quiz, User $student)
    {
        return $this->getStudentQuizScore($quiz, $student);
    }

    public function getStudentQuizScore(Quiz $quiz, User $student)
    {

        $questions = $quiz->questions;

        $score = 0;
        $questions_count = $questions->count();

        foreach ($questions as $question) {
            $gather = new GatherStudentQuestionCorrectness();
            $correct = $gather($student, $question);
            // if ($question->id == 6) {
            //     dd($question, $correct, 'score_before', $score, 'score', $score++);
            // }
            if ($correct) {
                $score++;
            }
        }

        return $score / $questions_count;
    }
}
