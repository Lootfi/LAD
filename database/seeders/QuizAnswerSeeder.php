<?php

namespace Database\Seeders;

use App\Models\QuizAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => true,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => false,
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => true,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => false,
        ]);
    }
}
