<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GatherStudentQuestionCorrectness
{
    public function __invoke(User $student, QuizQuestion $question)
    {
        $data = $this->getQuestionCorrectness($student, $question);

        return $data;
    }

    public function getQuestionCorrectness(User $student, QuizQuestion $question)
    {
        $correct = false;

        $studentResponseAnswers = $question->responses()->where('student_id', $student->id)->with('answer')->get()->pluck('answer');

        $correctAsnwers = $question->answers()->where('right_answer', true)->get();

        if ($correctAsnwers->diff($studentResponseAnswers)->isEmpty() && $studentResponseAnswers->diff($correctAsnwers)->isEmpty()) {
            $correct = true;
        }

        return $correct;
    }
}
