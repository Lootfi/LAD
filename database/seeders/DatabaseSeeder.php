<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //        $this->call([UsersTableSeeder::class]);
        $this->call([
            PermissionsSeeder::class,
            CourseSeeder::class,
            SectionSeeder::class,
            LessonSeeder::class,
            QuizSeeder::class,
            CourseStudentSeeder::class,
            QuizQuestionSeeder::class,
            QuizAnswerSeeder::class,
            QuizStudentSeeder::class,
            QuizResponseSeeder::class,
            ActivitySeeder::class,
            KcSeeder::class,
        ]);
    }
}
