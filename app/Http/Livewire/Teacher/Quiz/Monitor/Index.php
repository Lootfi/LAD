<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\User;
use App\Services\Quiz\GatherQuizMonitorData;
use Livewire\Component;

class Index extends Component
{

    public Course $course;
    public Quiz $quiz;

    protected $listeners = [
        'selectQuestion' => 'selectQuestion',
        'deselectQuestion' => 'deselectQuestion',
    ];

    public function mount(Course $course, Quiz $quiz)
    {
        $this->course = $course;
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.index');
    }

    public function selectQuestion(QuizQuestion $question)
    {
        $gather = new GatherQuizMonitorData;

        $data = $gather($this->quiz, $question);

        // emit data to graph component
        $this->emitTo('teacher.quiz.monitor.graphs.one', 'gatherData', $question->id, $data);
    }

    function deselectQuestion(QuizQuestion $question)
    {
        $this->emitTo('teacher.quiz.monitor.graphs.one', 'removeData', $question->id);
    }
}
