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
        QuizQuestion::factory(2)->create([
            'quiz_id' => 1,
        ]);
        QuizQuestion::factory(2)->create([
            'quiz_id' => 2,
        ]);
    }
}
