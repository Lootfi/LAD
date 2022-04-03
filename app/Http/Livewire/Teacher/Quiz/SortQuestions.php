<?php

namespace App\Http\Livewire\Teacher\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class SortQuestions extends Component
{
    public Quiz $quiz;

    public function render()
    {
        return view('livewire.teacher.quiz.sort-questions');
    }
}
