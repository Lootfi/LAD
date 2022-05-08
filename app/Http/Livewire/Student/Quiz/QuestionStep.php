<?php

namespace App\Http\Livewire\Student\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizResponse;
use App\Models\QuizStudent;
use App\Services\Quiz\GetStudentQuizScore;
use Illuminate\Support\Facades\DB;
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

        // checkTime
        $this->checkTime();

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

    public function saveResponses($submit = false)
    {

        // checkTime
        $this->checkTime();

        // delete responses not in $responses array (if any)
        QuizResponse::query()
            ->where('student_id', auth()->user()->id)
            ->where('question_id', $this->question->id)
            ->whereNotIn('answer_id', $this->responses)
            ->delete();

        // create newly added responses
        foreach ($this->responses as $answerId) {
            DB::transaction(function () use ($answerId) {
                QuizResponse::query()
                    ->firstOrCreate([
                        'student_id' => auth()->user()->id,
                        'question_id' => $this->question->id,
                        'answer_id' => $answerId,
                    ]);
            });
        }

        if ($submit) {
            $score = $this->getScore();
            DB::transaction(function () use ($score) {
                //indicate that student has finished quiz
                QuizStudent::query()
                    ->where('quiz_id', $this->quiz->id)
                    ->where('student_id', auth()->user()->id)
                    ->update(['submitted' => true, 'submitted_at' => now(), 'score' => $score]);
            });
        }

        event(new \App\Events\Student\QuestionAnswered(auth()->user(), $this->question));
    }

    public function checkTime()
    {
        if ($this->quiz->end_date < now()) {
            return redirect()->route('student.quiz.results', ['course' => $this->quiz->course, 'quiz' => $this->quiz]);
        }
    }

    public function getScore()
    {
        $getScore = new GetStudentQuizScore;

        return $getScore($this->quiz, auth()->user());
    }


    public function render()
    {
        return view('livewire.student.quiz.question-step');
    }
}
