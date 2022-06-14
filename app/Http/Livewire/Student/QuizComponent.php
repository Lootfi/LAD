<?php

namespace App\Http\Livewire\Student;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizStudent;
use App\Models\User;
use Livewire\Component;

class QuizComponent extends Component
{
    public Quiz $quiz;

    public User $student;

    public QuizQuestion $active_question;

    public function getListeners()
    {
        return [
            'saveResponses' => 'saveResponses',
            'nextQuestion' => 'nextQuestion',
            // "echo:quiz.{$this->quiz->id}.student.{$this->student->id}.kcs,Student\QuizKcAwarenessWarning" => "notified"
        ];
    }

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.answers');
        $this->student = auth()->user();
        $this->active_question = $this->quiz->questions->first();

        QuizStudent::firstOrCreate([
            'quiz_id' => $this->quiz->id,
            'student_id' => auth()->user()->id,
            'submitted' => false,
        ]);

        activity('student.quiz.start')
            ->event('started')
            ->causedBy($this->student)
            ->performedOn($this->quiz)
            ->log('Student started quiz');
    }

    public function render()
    {
        return view('livewire.student.quiz-component');
    }

    public function nextQuestion($current_step)
    {
        $this->active_question = $this->quiz->questions[$current_step + 1];
    }

    public function setActiveQuestion(QuizQuestion $question)
    {
        $this->active_question = $question;
    }

    public function submitQuiz()
    {
        //save last question responses and submit
        $this->emitTo('student.quiz.question-step', 'saveResponses', true); // boolean indicats $submit

        $this->logQuizSubmit();

        //redirect to results page
        return redirect()->route('student.quiz.results', ['course' => $this->quiz->course, 'quiz' => $this->quiz]);
    }

    public function logQuizSubmit()
    {
        activity('student.quiz.submit')
            ->event('submitted')
            ->causedBy(auth()->user())
            ->performedOn($this->quiz)
            ->log('Student submitted quiz');
    }
}
