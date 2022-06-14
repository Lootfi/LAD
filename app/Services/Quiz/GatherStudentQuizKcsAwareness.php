<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\User;

class GatherStudentQuizKcsAwareness
{
    public function __invoke(User $student, Quiz $quiz)
    {
        $data = $this->getKcsAwareness($student, $quiz);

        return $data;
    }

    public function getKcsAwareness(User $student, Quiz $quiz)
    {
        $kcs = $quiz->kcs()->with('kc')->get()->pluck('kc')->unique();

        $kcAware = [];
        foreach ($kcs as $kc) {
            $correctQuestion = [];
            $questions = $kc->questions()->where('quiz_id', $quiz->id)->get();

            $gatherQuestionCorrectness = new GatherStudentQuestionCorrectness;

            foreach ($questions as $question) {
                $studentAnsweredQuestion = $question->responses()->where('student_id', $student->id)->get()->isNotEmpty();
                if ($studentAnsweredQuestion) {
                    $correctQuestion[$question->id] = $gatherQuestionCorrectness($student, $question) ? 1 : 0;
                } else {
                    $correctQuestion[$question->id] = -1;
                }
            }

            $count = array_count_values($correctQuestion);

            if (! isset($count[1])) {
                $count[1] = 0;
            }
            if (! isset($count[0])) {
                $count[0] = 0;
            }
            if (! isset($count[-1])) {
                $count[-1] = 0;
            }

            $kcAware[$kc->id] = $this->compareCorrectResponsesCount($count[1], $count[0], $count[-1]);
        }

        return $kcAware;
    }

    public function compareCorrectResponsesCount($correct, $uncorrect, $unanswered)
    {
        if ($correct > $uncorrect) {
            if ($correct == $unanswered) {
                return -1;
            }
            if ($correct > $unanswered) {
                return 1;
            } else {
                return -1;
            }
        } else {
            if ($correct == $uncorrect) {
                return -1;
            }
            if ($uncorrect > $unanswered) {
                return 0;
            } else {
                return -1;
            }
        }
    }
}
