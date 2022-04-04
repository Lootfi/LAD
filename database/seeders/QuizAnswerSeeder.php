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
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);


        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => true,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);


        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => true,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);


        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => true,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);
    }
}
