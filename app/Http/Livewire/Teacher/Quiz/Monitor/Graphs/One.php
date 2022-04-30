<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;

class One extends Component
{
    public $quiz;
    public $graph_data = [];

    protected $listeners = [
        'gatherData' => 'gatherData',
        'removeData' => 'removeData',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.one');
    }

    public function gatherData(QuizQuestion $question, $data)
    {
        $this->graph_data[$question->id] = [
            ...$data
        ];
    }

    public function removeData(QuizQuestion $question)
    {
        unset($this->graph_data[$question->id]);
    }
}
