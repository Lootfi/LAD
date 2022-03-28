<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // start date two days from now
            'start_date' => now()->addDays(2),
            // duration is 30 minutes
            'duration' => 30,
            // random number in quiz name "Quiz #"
            'name' => 'Quiz #' . rand(1, 100),
            'course_id' => 1,
        ];
    }
}
