<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor\Logs\Student;

use App\Models\Quiz;
use App\Models\User;
use App\Services\Quiz\GatherStudentQuestionCorrectness;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Index extends Component
{

    public User $student;
    public Quiz $quiz;
    public $logs;

    public function mount(User $student, Quiz $quiz)
    {
        $this->student = $student;
        $this->quiz = $quiz;
        
        $question_ids = $this->quiz->questions->pluck('id')->toArray();

        $submit_log = Activity::query()
        ->where('log_name', 'student.quiz.submit')
        ->where('causer_id', $this->student->id)
        ->where('subject_id', $this->quiz->id)
        ->first();

        $responses_logs = Activity::query()
        ->where('log_name', 'student.question.response')
        ->where('properties->attributes->student_id', $this->student->id)
        ->whereIn('properties->attributes->question_id', $question_ids)
        ->get()
        ->each(function ($log) {
            $getCorrect = new GatherStudentQuestionCorrectness;
            $log->correct = $getCorrect($this->student, $this->quiz->questions()->where('id', $log->properties['attributes']['question_id'])->first());
        });

        $logs = collect();
        if ($responses_logs) {
            $logs->push($responses_logs);
        }
        if ($submit_log) {
            $logs->push($submit_log);
        }
        $this->logs = $logs->flatten();

        
    }

    public function render()
    {
        return view('livewire.teacher.quiz.monitor.logs.student.index');
    }
}
