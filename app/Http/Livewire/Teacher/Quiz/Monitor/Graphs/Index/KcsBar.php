<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs\Index;

use App\Models\Kc;
use App\Models\Quiz;
use KcFacade;
use Livewire\Component;

class KcsBar extends Component
{
    public $quiz;

    public $kcs;

    public $selected_kcs = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->kcs = $this->quiz->kcs()->with('kc')->get()->pluck('kc')->unique();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.index.kcs-bar');
    }

    public function clickKc(Kc $kc)
    {
        if (in_array($kc->id, $this->selected_kcs)) {
            $this->selected_kcs = array_diff($this->selected_kcs, [$kc->id]);
            $this->emitTo('teacher.quiz.monitor.graphs.index.kc-error-rate', 'removeData', $kc->id);
        } else {
            array_push($this->selected_kcs, $kc->id);

            $data = KcFacade::getQuizErrorRate($kc, $this->quiz);

            $this->emitTo('teacher.quiz.monitor.graphs.index.kc-error-rate', 'gatherData', $kc->id, $data);
        }
    }

    public function selectAll()
    {
        if (count($this->selected_kcs) == $this->kcs->count()) {
            $this->selected_kcs = [];
            $this->emitTo('teacher.quiz.monitor.graphs.index.kc-error-rate', 'removeAll');
        } else {
            $this->selected_kcs = $this->quiz->kcs()->with('kc')->get()->pluck('kc.id')->unique()->flatten()->toArray();

            $data = [];

            foreach ($this->kcs as $kc) {
                $kc = Kc::find($kc['id']);
                $data[$kc->name] = KcFacade::getQuizErrorRate($kc, $this->quiz);
            }

            $this->emitTo('teacher.quiz.monitor.graphs.index.kc-error-rate', 'gatherAll', $data);
        }
    }
}
