<?php

namespace Database\Seeders;

use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of France?',
            'order' => 1,
        ]);
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





        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of Germany?',
            'order' => 2,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => false,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => true,
            'answer' => 'Berlin',
        ]);





        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of Algeria?',
            'order' => 3,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => true,
            'answer' => 'Algiers',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);





        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of Nigeria?',
            'order' => 4,
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => true,
            'answer' => 'Abuja',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);





        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of Egypt?',
            'order' => 5,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 5,
            'right_answer' => true,
            'answer' => 'Cairo',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 5,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);





        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of South-Korea?',
            'order' => 6,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 6,
            'right_answer' => true,
            'answer' => 'Seoul',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 6,
            'right_answer' => false,
            'answer' => 'Paris',
        ]);






        QuizQuestion::factory()->create([
            'quiz_id' => 2,
            'question' => 'What is the capital of France?',
            'order' => 1,
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 7,
            'right_answer' => true,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 7,
            'right_answer' => false,
            'answer' => 'Berlin',
        ]);





        QuizQuestion::factory()->create([
            'quiz_id' => 2,
            'question' => 'What is the capital of Germany?',
            'order' => 2,
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 8,
            'right_answer' => false,
            'answer' => 'Paris',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 8,
            'right_answer' => true,
            'answer' => 'Berlin',
        ]);
    }
}
