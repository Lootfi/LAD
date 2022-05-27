<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\QuizQuestion;
use App\Services\Quiz\GatherQuizQuestionsErrorRate;

class FetchSplittableKcs
{
    public Course $course;
    public function __invoke(Course $course, $split_percentage)
    {
        $this->course = $course;

        $all_questions = $this->course->quizzes()->with('questions.kcs')->get()->pluck('questions')->flatten();

        $grouped_questions = $all_questions->groupBy(function(QuizQuestion $question) {
                 return implode('', array_column($question->kcs->toArray(), 'id'));
        })->filter(function ($group) {
            return $group->count() >= 2;
        });

        $all_err_diffs = $this->getDiffsInGroups($grouped_questions, $split_percentage);

        return $all_err_diffs;

    }


    public function getDiffsInGroups($questions_groups, $split_percentage)
    {
        $getErrorRate = new GatherQuizQuestionsErrorRate;

        $all_err_diffs = [];

        // goes over every group of questions
        foreach ($questions_groups as $questions_group) {

            $group_questions = collect();

            $error_rates = [];
            // in every group of questions, get the error rate for each question
            foreach ($questions_group as $key => $question) {
                $group_questions->push($question);
                $error_rates[$key]  = [
                    'error_rate' => $getErrorRate($question)['error_rate'],
                    'question_id' => $question->id
                ];
            }

            $differences = [];
            // for every group of questions, calculate the difference between every two questions
            // and get only diffs that are > split percentage
            for( $i=0; $i < count($error_rates) ; $i++ ){

                for( $j = $i + 1 ; $j < count($error_rates) ; $j++ ){
                    $diff = abs( $error_rates[$i]['error_rate'] -$error_rates[$j]['error_rate'] );

                    
                    
                    if($diff >= $split_percentage) {
                        array_push($differences, [
                            'diff' => $diff,
                            'q1' => $error_rates[$i]['question_id'],
                            'q2' => $error_rates[$j]['question_id'],
                        ]);
                    }

                }

            }

            if ($differences != []) {
                $group_data = [
                    'questions' => $group_questions,
                    'diffs' => $differences,
                    'kcs' => $group_questions->first()->kcs
                ];
                array_push($all_err_diffs, $group_data);
            }
        }

        return $all_err_diffs;
    }
}