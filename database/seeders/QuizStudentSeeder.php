<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\QuizStudent;
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
        $s1 = Course::first()->students->first();
        $s2 = Course::first()->students->get(1);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => $s1->id, 'submitted' => false]);
        QuizStudent::factory()->create(['quiz_id' => 1, 'student_id' => $s2->id, 'submitted' => false, 'score' => 0.00]);
    }
}
