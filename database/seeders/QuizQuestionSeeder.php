<?php

namespace Database\Seeders;

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
        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'What is the capital of Germany?',
            'order' => 2,
        ]);
        QuizQuestion::factory()->create([
            'quiz_id' => 2,
            'question' => 'What is the capital of France?',
            'order' => 1,
        ]);
        QuizQuestion::factory()->create([
            'quiz_id' => 2,
            'question' => 'What is the capital of Germany?',
            'order' => 2,
        ]);
    }
}
