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
            'start_date' => now(),
            'duration' => 90
        ]);
        Quiz::factory()->create([
            'start_date' => now()->addDays(2),
        ]);
    }
}
