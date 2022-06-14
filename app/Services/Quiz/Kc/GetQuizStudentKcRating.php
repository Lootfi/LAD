<?php

namespace App\Services\Quiz\Kc;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\User;
use App\Services\Quiz\GatherStudentQuestionCorrectness;

class GetQuizStudentKcRating
{
    public function __invoke(Quiz $quiz, Kc $kc, User $student)
    {
        $data = $this->getRating($quiz, $kc, $student);

        return $data * 100;
    }

    public function getRating(Quiz $quiz, Kc $kc, User $student)
    {
        $questions = $this->getQuestions($quiz, $kc, $student);

        $correct = [];

        foreach ($questions as $question) {
            $getQuestionCorrectness = new GatherStudentQuestionCorrectness;
            $correct[$question->id] = $getQuestionCorrectness($student, $question) ? 1 : 0;
        }

        $count = array_count_values($correct);

        if (! isset($count[1])) {
            $count[1] = 0;
        }

        return $count[1] / $questions->count();
    }

    public function getQuestions(Quiz $quiz, Kc $kc, User $student)
    {
        $quiz_student = $quiz->students()->where('student_id', $student->id)->first();
        if ($quiz_student != null && $quiz_student->submitted) {
            return $kc->questions()
                ->where('quiz_id', $quiz->id)
                ->get();
        } else {
            // only answered questions
            return $kc->questions()
                ->where('quiz_id', $quiz->id)
                ->whereHas('responses', function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                })
                ->get();
        }
    }
}
