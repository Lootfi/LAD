<?php

namespace Database\Seeders;

use App\Models\Course;
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
        //activity for Student 01 on course 01

        $student01 = User::find(2);
        $course01 = Course::find(1);

        for ($i = 0; $i < 100; $i++) {
            activity('student.course.show')
                ->causedBy($student01)
                ->performedOn($course01)
                ->createdAt(now()->subDays($i * 0.5))
                ->log('Student viewed course');
        }

        //activity for Student 02 on course 01
        $student02 = User::find(3);

        for ($i = 0; $i < 10; $i++) {
            activity('student.course.show')
                ->causedBy($student02)
                ->performedOn($course01)
                ->createdAt(now()->subDays($i * 0.5))
                ->log('Student viewed course');
        }
    }
}
