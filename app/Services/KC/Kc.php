<?php

namespace App\Services\KC;

use App\Models\Course;
use App\Models\Kc as KcModel;
use App\Models\Quiz;
use App\Models\User;
use App\Services\Course\FetchSplittableKcs;
use App\Services\Course\Kc\GetCourseKcsAwareness;
use App\Services\Quiz\GatherQuizKcsErrorRate;
use App\Services\Quiz\GatherStudentQuizKcsAwareness;
use App\Services\Quiz\Kc\GetQuizStudentKcRating;

class Kc
{
    public static function getStudentRating(KcModel $kc, User $student)
    {
        return (new GetCourseKcsAwareness)($kc, $student);
    }

    public static function getStudentRatingInQuiz(KcModel $kc, User $student, Quiz $quiz)
    {
        return (new GetQuizStudentKcRating)($quiz, $kc, $student);
    }

    public static function getQuizErrorRate(KcModel $kc, Quiz $quiz)
    {
        return (new GatherQuizKcsErrorRate)($quiz, $kc);
    }

    public static function fetchSplittable(Course $course, $split_percentage)
    {
        return (new FetchSplittableKcs)($course, $split_percentage);
    }

    public static function getStudentAwarenessInQuiz(User $student, Quiz $quiz)
    {
        return (new GatherStudentQuizKcsAwareness)($student, $quiz);
    }
}
