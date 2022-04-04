<?php

namespace App\Http\Livewire\Teacher\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;

class SortQuestions extends Component
{
    public Quiz $quiz;
    public array $questions;

    public function reorderQuestions($newOrderIds)
    {
        foreach ($newOrderIds as  $order => $id) {
            QuizQuestion::where('id', $id)->update(['order' => $order + 1]);
        }
        $this->questions = $this->quiz->questions()->orderBy('order')->get()->toArray();
    }

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->questions = $this->quiz->questions()->orderBy('order')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.sort-questions');
    }
}
