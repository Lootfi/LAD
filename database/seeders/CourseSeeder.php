<?php

namespace Database\Seeders;

use App\Models\Course;
use Database\Factories\CourseFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory(1)->create(
            [
                'title' => 'Software Engineering 2021-2022',
            ]
        );

        Course::factory(1)->create(
            [
                'title' => 'Machine Learning 2021-2022',
                'teacher_id' => 2,
            ]
        );
    }
}
