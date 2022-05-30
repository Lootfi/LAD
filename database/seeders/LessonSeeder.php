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
        Lesson::factory()->create([
            'name' => 'Software Development Models',
            'description' => 'cascade, v, spirale',
            'section_id' => 1,
        ]);

        Lesson::factory()->create([
            'name' => 'Design Patterns',
            'description' => 'Création, Structurels, Comportementaux',
            'section_id' => 1,
        ]);

        Lesson::factory()->create([
            'name' => 'OCL',
            'description' => 'Navigation, Opérations, Types',
            'section_id' => 1,
        ]);


        Lesson::factory(3)->create([
            'section_id' => 2,
        ]);
        Lesson::factory(3)->create([
            'section_id' => 3,
        ]);

        // course 2

        // 10 - 18

        Lesson::factory()->create([
            'name' => 'Python 101',
            'description' => '',
            'section_id' => 4,
        ]);

        Lesson::factory()->create([
            'name' => 'Numpy 101',
            'description' => '',
            'section_id' => 4,
        ]);

        Lesson::factory()->create([
            'name' => 'scikit-learn 101',
            'description' => '',
            'section_id' => 4,
        ]);
    }
}
