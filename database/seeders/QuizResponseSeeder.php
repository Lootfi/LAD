<?php

namespace Database\Seeders;

use App\Models\QuizResponse;
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
        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 1,
            'answer_id' => 1 // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 1,
            'answer_id' => 2 // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 2,
            'answer_id' => 4 //4-5
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 3,
            'answer_id' => 7 //6-8
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 4,
            'answer_id' => 10 //10-12
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 5,
            'answer_id' => 14 //13-15
        ]);

        QuizResponse::factory()->create([
            'student_id' => 2,
            'question_id' => 6,
            'answer_id' => 16 //16-18
        ]);

        // =====================================

        // Student 02

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 1,
            'answer_id' => 3 // 1-3
        ]);

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 2,
            'answer_id' => 4 //4-5
        ]);

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 3,
            'answer_id' => 7 //6-8
        ]);

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 4,
            'answer_id' => 10 //10-12
        ]);

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 5,
            'answer_id' => 13 //13-15
        ]);

        QuizResponse::factory()->create([
            'student_id' => 3,
            'question_id' => 6,
            'answer_id' => 17 //16-18
        ]);
    }
}
