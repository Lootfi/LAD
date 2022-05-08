<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizStudent;
use App\Models\User;
use App\Services\Quiz\GetStudentQuizScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 2, 'submitted' => false]);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 4, 'submitted' => false]);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 5, 'submitted' => false]);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 6, 'submitted' => false]);

        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 3, 'submitted' => false, 'score' => 0.00]);
    }
}
