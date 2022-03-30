<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class QuizCountdownTimer extends Component
{
    // quiz
    public $quiz;

    // mount

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.quiz-countdown-timer');
    }
}
