<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // course 1
        Section::factory(1)->create([
            'name' => "Introduction",
        ]);

        Section::factory(1)->create([
            'name' => "Linux Basics",
        ]);

        Section::factory(1)->create([
            'name' => "Databases",
        ]);

        // course 2

        Section::factory(1)->create([
            'course_id' => 2,
            'name' => "Introduction",
        ]);

        Section::factory(1)->create([
            'course_id' => 2,
            'name' => "Linear Regression",
        ]);

        Section::factory(1)->create([
            'course_id' => 2,
            'name' => "Unsupervised Learning",
        ]);
    }
}
