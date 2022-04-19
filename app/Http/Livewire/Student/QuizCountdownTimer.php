<?php

namespace App\Http\Livewire\Student;

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
        return view('livewire.student.quiz-countdown-timer');
    }

    public function countdown()
    {
        if ($this->quiz->start_date >= now()) {
            $this->emitUp('start_quiz');
        }
    }
}
