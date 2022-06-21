<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::factory()->create([
            'start_date' => now()->addMinutes(20),
            'duration' => 20,
        ]);
        Quiz::factory()->create([
            'course_id' => 2,
            'start_date' => now(),
            'duration' => 20,
        ]);
    }
}
