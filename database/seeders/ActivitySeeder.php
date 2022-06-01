<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course01 = Course::find(1);
        
        $course01_views = [25, 23 ,25, 13, 2];
        $lessons_course01_views = [9, 3 ,5, 3, 4, 7 ,2 ,7 ,8];

        foreach ($course01->students as $key => $student) {
            for ($i = 0; $i < $course01_views[$key]; $i++) {
                activity('student.course.show')
                    ->causedBy($student)
                    ->performedOn($course01)
                    ->createdAt(now()->subDays($i * 0.5))
                    ->log('Student viewed course');
            }
        }

        foreach ($course01->lessons as $key => $lesson) {
            foreach ($course01->students->random(random_int(1,5)) as $student) {
                for ($i = 0; $i < $lessons_course01_views[$key]; $i++) {
                    activity('student.lesson.show')
                        ->causedBy($student)
                        ->performedOn($lesson)
                        ->createdAt(now()->subDays($i * rand(0.5, 2)))
                        ->log('Student viewed lesson');
                }
            }
        }

        $course02 = Course::find(2);

        $course02_views = [25, 23 ,25, 13, 2];
        $lessons_course02_views = [9, 3 ,5];

        foreach ($course02->students as $key => $student) {
            for ($i = 0; $i < $course02_views[$key]; $i++) {
                activity('student.course.show')
                    ->causedBy($student)
                    ->performedOn($course02)
                    ->createdAt(now()->subDays($i * 0.5))
                    ->log('Student viewed course');
            }
        }

        foreach ($course02->lessons as $key => $lesson) {
            foreach ($course02->students->random(random_int(1,5)) as $student) {
                for ($i = 0; $i < $lessons_course02_views[$key]; $i++) {
                    activity('student.lesson.show')
                        ->causedBy($student)
                        ->performedOn($lesson)
                        ->createdAt(now()->subDays($i * rand(0.5, 2)))
                        ->log('Student viewed lesson');
                }
            }
        }
    }
}
