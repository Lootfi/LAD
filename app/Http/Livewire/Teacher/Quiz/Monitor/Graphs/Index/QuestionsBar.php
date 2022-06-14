<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Graphs\Index;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use Livewire\Component;
use QuizFacade;

class QuestionsBar extends Component
{
    public $quiz;

    public $selected_questions = [];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.graphs.index.questions-bar');
    }

    public function clickQuestion(QuizQuestion $question)
    {
        if (in_array($question->id, $this->selected_questions)) {
            $this->selected_questions = array_diff($this->selected_questions, [$question->id]);
            $this->emitTo('teacher.quiz.monitor.graphs.index.questions-error-rate', 'removeData', $question->id);
        } else {
            array_push($this->selected_questions, $question->id);

            $data = QuizFacade::getQuestionErrorRate($question);

            $this->emitTo('teacher.quiz.monitor.graphs.index.questions-error-rate', 'gatherData', $question->id, $data);
        }
    }
}
