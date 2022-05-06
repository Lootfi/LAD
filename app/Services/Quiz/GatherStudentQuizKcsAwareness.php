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
            $countCorrectQuestion = [];
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

            if (!isset($count[1])) $count[1] = 0;
            if (!isset($count[0])) $count[0] = 0;
            if (!isset($count[-1])) $count[-1] = 0;

            //all equal
            if (($count[-1] == $count[0]) && ($count[0] == $count[1])) {
                # code...
                $kcAware[$kc->id] = -1;
            } elseif (($count[1] > $count[0]) && ($count[1] > $count[-1])) {
                // aware only if count of questions answered right is higher than everything
                $kcAware[$kc->id] = 1;
            } elseif (($count[0] > $count[-1]) && ($count[0] > $count[1])) {
                // not aware only if count of questions answered false is higher than everything
                $kcAware[$kc->id] = 0;
                # code...
            } else {
                // not yet if everything else
                $kcAware[$kc->id] = -1;
            }
        }

        return $kcAware;
    }
}
