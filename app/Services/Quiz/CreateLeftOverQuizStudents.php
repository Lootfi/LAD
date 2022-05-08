<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\QuizStudent;

class CreateLeftOverQuizStudents
{

    public function __invoke(Quiz $quiz)
    {
        $this->createQuizStudents($quiz);
    }

    public function createQuizStudents(Quiz $quiz)
    {
        $getScore = new GetStudentQuizScore;

        foreach ($quiz->course->students as $student) {
            QuizStudent::query()
                ->firstOrCreate(
                    [
                        'quiz_id' => $quiz->id,
                        'student_id' => $student->id
                    ],
                    [
                        'submitted' => false,
                        'submitted_at' => $quiz->end_date,
                        'score' => $getScore($quiz, $student)
                    ]
                );
        }
    }
}
