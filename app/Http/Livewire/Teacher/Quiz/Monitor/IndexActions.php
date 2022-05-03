<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Quiz;
use Livewire\Component;

class IndexActions extends Component
{

    public $quiz;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.index-actions');
    }

    public function clearSelectedQuestions()
    {
        $this->emit('clearSelectedQuestions');
        $this->emitTo('teacher.quiz.monitor.graphs.index.questions-error-rate', 'removeAllData');
    }
}
