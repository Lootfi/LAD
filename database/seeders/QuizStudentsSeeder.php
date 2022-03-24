<?php

namespace Database\Seeders;

use App\Models\QuizStudents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizStudents::factory()->create(['quiz_id' => 1, 'student_id' => 1]);
        QuizStudents::factory()->create(['quiz_id' => 1, 'student_id' => 2]);
    }
}
