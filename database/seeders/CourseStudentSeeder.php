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
        CourseStudent::factory(1)->create([
            'course_id' => 1,
            'student_id' => 3,
        ]);

        CourseStudent::factory(1)->create([
            'course_id' => 1,
            'student_id' => 4,
        ]);

        CourseStudent::factory(1)->create([
            'course_id' => 1,
            'student_id' => 5,
        ]);

        CourseStudent::factory(1)->create([
            'course_id' => 1,
            'student_id' => 6,
        ]);

        CourseStudent::factory(1)->create([
            'course_id' => 1,
            'student_id' => 7,
        ]);
    }
}
