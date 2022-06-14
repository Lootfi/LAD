<?php

namespace App\Services\Quiz;

use App\Models\Quiz as QuizModel;
use App\Models\QuizQuestion;
use App\Models\User;
use App\Services\Quiz\Question\GetCorrectResponsesRate;

class Quiz
{
    public static function hello()
    {
        dd('help');
    }

    public static function createLeftOverStudents(QuizModel $quiz)
    {
        return (new CreateLeftOverQuizStudents)($quiz);
    }

    public static function getQuestionCorrectness(User $student, QuizQuestion $question)
    {
        return (new GatherStudentQuestionCorrectness)($student, $question);
    }

    public static function getPassPercentage(QuizModel $quiz)
    {
        return (new GetQuizPassPercentage)($quiz);
    }

    public static function getStudentScore(QuizModel $quiz, User $student)
    {
        return (new GetStudentQuizScore)($quiz, $student);
    }

    public static function getQuestionErrorRate(QuizQuestion $question)
    {
        return (new GatherQuizQuestionsErrorRate)($question);
    }

    public static function getQuestionCorrectResponsesRate(QuizQuestion $question)
    {
        return (new GetCorrectResponsesRate)($question);
    }
}
