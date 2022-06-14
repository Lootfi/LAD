<?php

namespace App\Services\Course\Kc;

use App\Models\Course;
use App\Models\Kc;
use App\Models\User;
use App\Services\Quiz\GatherStudentQuizKcsAwareness;

class GetCourseKcsAwareness
{
    public function __invoke(Kc $kc, User $student)
    {
        // get all quizzes
        $quizzes = $this->getQuizzes($kc);

        $quiz_kcs_awareness = $this->getAwareness($quizzes, $student);

        $student_kc_awarenesses = [];

        foreach ($quiz_kcs_awareness as $quiz_kcs) {
            if (isset($quiz_kcs[$kc->id])) {
                array_push($student_kc_awarenesses, $quiz_kcs[$kc->id]);
            }
        }

        $count = array_count_values($student_kc_awarenesses);

        if (! isset($count[1])) {
            $count[1] = 0;
        }
        if (! isset($count[0])) {
            $count[0] = 0;
        }
        if (! isset($count[-1])) {
            $count[-1] = 0;
        }

        if ($count[1] == 0) {
            return 0;
        } elseif ($count[-1] == 0 && $count[1] == 0) {
            return 'UNDETERMINED';
        }

        return ($count[1] / count($student_kc_awarenesses)) * 100;
    }

    public function getQuizzes(Kc $kc)
    {
        return $kc->questions()->with('quiz')->get()->pluck('quiz')->unique()->where('status', 'closed');
    }

    public function getAwareness($quizzes, User $student)
    {
        $awareness = [];

        $getAwareness = new GatherStudentQuizKcsAwareness;

        foreach ($quizzes as $quiz) {
            $awareness[$quiz->id] = $getAwareness($student, $quiz);
        }

        return $awareness;
    }
}
