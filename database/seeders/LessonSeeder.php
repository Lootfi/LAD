<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::factory(3)->create([
            'section_id' => 1,
        ]);
        Lesson::factory(3)->create([
            'section_id' => 2,
        ]);
        Lesson::factory(3)->create([
            'section_id' => 3,
        ]);
    }
}
