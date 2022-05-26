<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs\Index;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;

class KcErrorRate extends Component
{


    public $quiz;
    public $graph_data = [];

    protected $listeners = [
        'gatherData' => 'gatherData',
        'removeData' => 'removeData',
        'gatherAll' => 'gatherAll',
        'removeAll' => 'removeAll',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.index.kc-error-rate');
    }

    public function gatherData(Kc $kc, $data)
    {
        $this->graph_data[$kc->name] = [
            ...$data
        ];

        $this->emit('addKcDataToGraph', $kc->name, $data);
    }

    public function removeData(Kc $kc)
    {
        unset($this->graph_data[$kc->name]);

        $this->emit('deleteKcDataFromGraph', $kc->name);
    }

    public function removeAll()
    {
        $this->graph_data = [];

        $this->emit('deleteAllKcDataFromGraph');
    }

    public function gatherAll(array $data)
    {
        $this->graph_data = $data;

        $this->emit('addAllKcDataToGraph', $data);
    }
}
