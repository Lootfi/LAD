<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([3,4,5,6,7] as $student_id) {
            CourseStudent::factory(1)->create([
                'course_id' => 1,
                'student_id' => $student_id,
            ]);
            CourseStudent::factory(1)->create([
                'course_id' => 2,
                'student_id' => $student_id,
            ]);
        }
    }
}
