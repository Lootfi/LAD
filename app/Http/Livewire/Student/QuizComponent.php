<?php

namespace App\Http\Livewire\Student;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizStudent;
use Livewire\Component;

class QuizComponent extends Component
{

    public Quiz $quiz;
    public QuizQuestion $active_question;

    public $listeners = [
        'saveResponses' => 'saveResponses',
        'nextQuestion' => 'nextQuestion',
    ];

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz->load('questions.answers');
        $this->active_question = $this->quiz->questions->first();

        QuizStudent::firstOrCreate([
            'quiz_id' => $this->quiz->id,
            'student_id' => auth()->user()->id,
            'submitted' => false,
        ]);
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
        //save last question responses
        $this->emit('saveResponses');

        //indicate that student has finished quiz
        QuizStudent::query()
            ->where('quiz_id', $this->quiz->id)
            ->where('student_id', auth()->user()->id)
            ->update(['submitted' => true]);

        //redirect to results page
        return redirect()->route('student.quiz.results', ['course' => $this->quiz->course, 'quiz' => $this->quiz]);
    }

    // check if time is up and redirect to results page
    public function checkTime()
    {
        if ($this->quiz->end_date <= now()) {
            return redirect()->route('student.quiz.results', ['course' => $this->quiz->course, 'quiz' => $this->quiz]);
        }
    }
}
