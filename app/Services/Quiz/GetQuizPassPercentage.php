<?php

namespace App\Services\Quiz;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use App\Services\Quiz\Question\GetCorrectResponsesRate;

class GetQuizPassPercentage
{

    public function __invoke(Quiz $quiz)
    {
        $percentage = $this->getPercentage($quiz);
        return $percentage;
    }

    public function getPercentage(Quiz $quiz)
    {
        $questions = $quiz->questions;
        $students = $quiz->course->students;

        // $correct_responses_total_rate = 0;

        // foreach ($questions as $question) {
        //     $correct_responses_rate = new GetCorrectResponsesRate;
        //     $rate = $correct_responses_rate($question);

        //     $correct_responses_total_rate += $rate;
        // }

        // return $correct_responses_total_rate / $quiz->course->students()->count();

        $pass_quiz_count = 0;

        foreach ($students as $student) {
            $correct = [];
            foreach ($quiz->questions as $question) {

                $studentResponseAnswers = $question->responses()->where('student_id', $student->id)->with('answer')->get()->pluck('answer');

                $correctAsnwers = $question->answers()->where('right_answer', true)->get();

                if ($correctAsnwers->diff($studentResponseAnswers)->isEmpty() && $studentResponseAnswers->diff($correctAsnwers)->isEmpty()) {
                    $correct[$question->id] = 1;
                } else {
                    $correct[$question->id] = 0;
                }
            }

            $count = array_count_values($correct);

            if (!isset($count[1])) $count[1] = 0;
            if (!isset($count[0])) $count[0] = 0;

            if (($count[1] >= $count[0])) {
                $pass_quiz_count++;
            }
        }

        return $pass_quiz_count / $quiz->course->students()->count();
    }
}
