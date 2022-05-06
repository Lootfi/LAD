<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Student;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use App\Services\Quiz\GatherStudentQuizKcsAwareness;
use Livewire\Component;

class Kcs extends Component
{
    public $student;
    public $quiz;
    public $kcs;
    public $kcs_awareness;

    public function getListeners()
    {
        return [
            "student.{$this->student->id}.answeredQuestion" => 'questionAnswered',
        ];
    }

    public function mount(User $student, Quiz $quiz)
    {
        $this->student = $student;
        $this->quiz = $quiz;

        $this->kcs = $quiz->kcs()->with('kc')->get()->pluck('kc')->unique()->pluck('name', 'id');
        $this->getAwareness();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.student.kcs');
    }

    public function questionAnswered(QuizQuestion $question)
    {
        $this->getAwareness();
    }

    public function getAwareness()
    {
        $gather = new GatherStudentQuizKcsAwareness;

        $kcsAwareness = $gather($this->student, $this->quiz);

        $this->kcs_awareness = $kcsAwareness;
    }
}
