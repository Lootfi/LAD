<?php

namespace Database\Seeders;

use App\Models\QuizStudent;
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
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 2, 'submitted' => true, 'submitted_at' => now()]);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => 3, 'submitted' => true, 'submitted_at' => now()]);
    }
}
