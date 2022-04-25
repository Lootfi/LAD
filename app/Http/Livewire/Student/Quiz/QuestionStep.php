<?php

namespace App\Http\Livewire\Student\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use Livewire\Component;

class QuestionStep extends Component
{
    public QuizQuestion $question;
    public Quiz $quiz;

    public $step; //current step
    public $lastQuestion; //boolean to indicate if this is the last question
    public $responses = []; //array of responses

    protected $listeners = [
        'saveResponses' => 'saveResponses',
    ];

    public function mount(QuizQuestion $question, $step)
    {
        $this->step = $step;

        $this->question = $question;
        $this->quiz = $this->question->quiz;

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

    public function saveResponses()
    {

        // delete responses not in $responses array (if any)
        QuizResponse::query()
            ->where('student_id', auth()->user()->id)
            ->where('question_id', $this->question->id)
            ->whereNotIn('answer_id', $this->responses)
            ->delete();

        // create newly added responses
        foreach ($this->responses as $answerId) {
            QuizResponse::query()
                ->firstOrCreate([
                    'student_id' => auth()->user()->id,
                    'question_id' => $this->question->id,
                    'answer_id' => $answerId,
                ]);
        }

        event(new \App\Events\Student\QuestionAnswered($this->quiz, $this->question));
    }


    public function render()
    {
        return view('livewire.student.quiz.question-step');
    }
}
