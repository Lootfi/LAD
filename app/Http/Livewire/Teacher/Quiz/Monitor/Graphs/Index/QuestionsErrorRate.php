<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs\Index;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;

class QuestionsErrorRate extends Component
{
    public $quiz;

    public $graph_data = [];

    protected $listeners = [
        'gatherData' => 'gatherData',
        'removeData' => 'removeData',
        'removeAllData' => 'removeAllData',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.index.questions-error-rate');
    }

    public function gatherData(QuizQuestion $question, $data)
    {
        $this->graph_data[$question->id] = [
            ...$data,
        ];

        $this->emit('addData', $question->id, $data);
    }

    public function removeData(QuizQuestion $question)
    {
        unset($this->graph_data[$question->id]);

        $this->emit('deleteData', $question->id);
    }

    public function removeAllData()
    {
        $this->graph_data = [];

        $this->emit('deleteAllData');
    }
}
