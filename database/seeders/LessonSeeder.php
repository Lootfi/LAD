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
            'name' => 'Modèles de Développement de Logiciels',
            'description' => 'cascade, v, spirale',
            'section_id' => 1,
        ]);

        Lesson::factory()->create([
            'name' => 'Patrons de Conception',
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
    }
}
