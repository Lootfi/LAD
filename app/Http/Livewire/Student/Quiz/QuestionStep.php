<?php

namespace App\Http\Livewire\Student\Quiz;

use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use Livewire\Component;

class QuestionStep extends Component
{
    public $question;
    public $step;
    public $quiz;
    public $lastQuestion;
    public $responses = [];

    protected $listeners = [
        'saveResponses' => 'saveResponses',
    ];

    public function mount(QuizQuestion $question, $step)
    {
        $this->step = $step;

        $this->question = $question;
        $this->quiz = $this->question->quiz;

        //load quiz responses
        $responsesCollection = $this->question->responses()
            ->where('student_id', auth()->user()->id)
            ->get('answer_id');

        foreach ($responsesCollection as $responseObj) {
            array_push($this->responses, $responseObj->answer_id);
        }
    }

    public function goToNextQuestion()
    {
        $this->saveResponses();
        $this->emitUp('nextQuestion', $this->step);
    }

    //saving student's response in database
    public function saveResponses()
    {
        foreach ($this->responses as $answerId) {
            QuizResponse::firstOrCreate([
                'student_id' => auth()->user()->id,
                'question_id' => $this->question->id,
                'answer_id' => $answerId,
            ]);
        }
    }


    public function render()
    {
        return view('livewire.student.quiz.question-step');
    }
}
