<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1 = Course::first()->students->first();
        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 1,
            'answer_id' => 1, // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 1,
            'answer_id' => 2, // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 2,
            'answer_id' => 4, //4-5
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 3,
            'answer_id' => 7, //6-8
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 4,
            'answer_id' => 9, //9-11
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 5,
            'answer_id' => 14, //12 - 14
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 6,
            'answer_id' => 15, //15-17
        ]);
        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 6,
            'answer_id' => 16, //15-17
        ]);
        QuizResponse::factory()->create([
            'student_id' => $s1->id,
            'question_id' => 6,
            'answer_id' => 17, //15-17
        ]);

        // =====================================

        // Student 02
        $s2 = Course::first()->students->get(1);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 1,
            'answer_id' => 1, // 1-3
        ]);
        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 1,
            'answer_id' => 2, // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 2,
            'answer_id' => 4, //4-5
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 3,
            'answer_id' => 7, //6-8
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 4,
            'answer_id' => 9, //9-11
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 5,
            'answer_id' => 13, //12-14
        ]);

        QuizResponse::factory()->create([
            'student_id' => $s2->id,
            'question_id' => 6,
            'answer_id' => 16, //15-17
        ]);
    }
}
