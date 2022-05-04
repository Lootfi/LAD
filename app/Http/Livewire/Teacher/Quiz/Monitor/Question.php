<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\QuizQuestion;
use App\Models\User;
use Livewire\Component;

class Question extends Component
{
    public User $student;
    public QuizQuestion $question;
    public $index;
    public $answered = false;
    public $correct = false;
    public $classes;
    public $selected = false;

    public function getListeners()
    {
        return [
            //{student_id}.answered.{question_id}
            "echo:{$this->student->id}.answered.{$this->question->id},Student\QuestionAnswered" => 'questionAnswered',
            'chooseQuestion.' . $this->question->id => 'chooseQuestionListener',
            "clearSelectedQuestions" => 'clearSelectedQuestionsListener',
        ];
    }

    public function mount(User $student, QuizQuestion $question)
    {
        $this->student = $student;
        $this->question = $question;
        $this->index = $question->order;
        $this->getAttributes();
        $this->classes = $this->getCssClasses();
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.question');
    }

    public function getAttributes()
    {
        $responses = $this->question->responses()->where('student_id', $this->student->id)->get();

        if ($responses->count() == 0) return;


        $studentResponseAnswers = $this->question->responses()->where('student_id', $this->student->id)->with('answer')->get()->pluck('answer');

        $correctAsnwers = $this->question->answers()->where('right_answer', true)->get();

        $this->answered = true;
        $correct = false;

        if ($correctAsnwers->diff($studentResponseAnswers)->isEmpty()) {
            $this->correct = true;
        } else {
            $this->correct = false;
        }
        // foreach ($this->question->answers()->where('right_answer', true)->get() as $answer) {
        //     if ($responses->where('answer_id', $answer->id)->count() > 0) {
        //         $correct = true;
        //     } else {
        //         $correct = false;
        //         break;
        //     }
        // }

        // foreach ($responses as $response) {
        //     if ($response->answer->right_answer) {
        //         $correct = true;
        //     } else {
        //         $correct = false;
        //         break;
        //     }
        // }

        // $this->correct = $correct;
    }

    public function getCssClasses()
    {
        if (!$this->answered) {
            return 'text-white bg-dark';
        } else {
            if ($this->correct) {
                return 'text-white bg-success';
            } else {
                return 'text-white bg-warning';
            }
        }
    }

    public function questionAnswered()
    {
        $this->getAttributes();
        $this->classes = $this->getCssClasses();
    }

    public function chooseQuestion()
    {
        $this->emit('chooseQuestion.' . $this->question->id);
        if ($this->selected) {
            $this->emitTo('teacher.quiz.monitor.index', 'deselectQuestion', $this->question->id);
        } else {
            $this->emitTo('teacher.quiz.monitor.index', 'selectQuestion', $this->question->id);
        }
    }

    public function chooseQuestionListener()
    {
        $this->selected = !$this->selected;
    }

    public function clearSelectedQuestionsListener()
    {
        if ($this->selected) {
            $this->selected = false;
        }
    }
}
