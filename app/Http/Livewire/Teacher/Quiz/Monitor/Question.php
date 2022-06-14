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

    public function getListeners()
    {
        return [
            "echo:{$this->student->id}.answered.{$this->question->id},Student\QuestionAnswered" => 'questionAnswered',
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
        if ($responses->count() == 0) {
            $this->answered = false;

            return;
        }

        $studentResponseAnswers = $this->question->responses()->where('student_id', $this->student->id)->with('answer')->get()->pluck('answer');
        $correctAsnwers = $this->question->answers()->where('right_answer', true)->get();

        $this->answered = true;

        if ($correctAsnwers->diff($studentResponseAnswers)->isEmpty() && $studentResponseAnswers->diff($correctAsnwers)->isEmpty()) {
            $this->correct = true;
        } else {
            $this->correct = false;
        }
    }

    public function getCssClasses()
    {
        if (! $this->answered) {
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
        $this->emitTo('teacher.quiz.monitor.student.kcs', 'student.'.$this->student->id.'.answeredQuestion', ['question_id' => $this->question->id]);
    }
}
