<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs\Student;

use App\Models\Kc;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use App\Services\Quiz\Kc\GetQuizStudentKcRating;
use Livewire\Component;

class KcsRadar extends Component
{
    public $quiz;
    public $student;
    public $kcs;

    public $graph_data = ['help'];

    // protected $listeners = [
    //     'gatherData' => 'gatherData',
    //     'removeData' => 'removeData',
    //     'removeAllData' => 'removeAllData',
    // ];

    public function mount(User $student, Quiz $quiz)
    {
        $this->student = $student;
        $this->quiz = $quiz;
        $this->getKcs();
        $this->initGraphData();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.student.kcs-radar');
    }

    public function getKcs()
    {

        $quiz_student = $this->quiz->students()->where('student_id', $this->student->id)->first();

        if ($quiz_student != null && $quiz_student->submitted) {
            $this->kcs = $this->quiz->kcs()->with('kc')->get()->pluck('kc')->unique();
        } else {
            $questions = QuizQuestion::query()
                ->whereHas('responses', function ($query) {
                    $query->where('student_id', $this->student->id);
                })
                ->get();
            if ($questions->isEmpty()) {
                $this->kcs = collect();
            } else {
                $kcs = collect();
                foreach ($questions as $question) {
                    $kcs = $kcs->push($question->kcs);
                }
                $this->kcs = $kcs->unique()->flatten();
            }
        }
    }

    public function initGraphData()
    {
        $graph_data = [];
        foreach ($this->kcs as $kc) {
            $getKcRating = new GetQuizStudentKcRating;
            $rating = $getKcRating($this->quiz, $kc, $this->student);
            $graph_data[$kc->name] = $rating;
        }
        $this->graph_data = $graph_data;
    }

    // public function gatherData(Kc $kc, $data)
    // {
    //     $this->graph_data[$kc->name] = [
    //         ...$data
    //     ];

    //     $this->emit('addDataToKcRadarGraph', $kc->name, $data);
    // }

    // public function removeData(Kc $kc)
    // {
    //     unset($this->graph_data[$kc->name]);

    //     $this->emit('deleteKcDataFromRadarGraph', $kc->name);
    // }

    // public function removeAllData()
    // {
    //     $this->graph_data = [];

    //     $this->emit('deleteAllKcDataFromRadarGraph');
    // }
}
