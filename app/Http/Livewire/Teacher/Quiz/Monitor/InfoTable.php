<?php

namespace App\Http\Livewire\Teacher\Quiz\Monitor;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizStudent;
use App\Services\Quiz\GatherStudentQuestionCorrectness;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class InfoTable extends Component
{
    public $quiz;
    public $students;
    public $students_online;
    public $students_passing_quiz_in_last_x;
    public $students_struggling;
    public $students_with_perfect_score;
    public $students_with_all_wrong_answers;
    public $students_who_havent_started_quiz_yet;

    public function mount(Quiz $quiz)
    {
        $this->quiz = $quiz;
        $this->students = $this->quiz->course->students;
        $this->getStudentsOnline();
        $this->getStudentsPassingQuizInLast('1 day');
        $this->getStudentsStruggling();
        $this->getStudentsWithPerfectScore();
        $this->getStudentsWithAllWrongAnswers();
        $this->getStudentsWhoHaventStartedQuizYet();
    }
    public function render()
    {
        return view('livewire.teacher.quiz.monitor.info-table');
    }

    public function getStudentsOnline()
    {
        $this->students_online = collect();

        foreach ($this->students as $student) {
            if ($student->isOnline())
                $this->students_online->push($student);
        }
    }

    public function getStudentsPassingQuizInLast(string $time)
    {
        // all ids of students related to this quiz
        $students_ids = $this->students->pluck('id')->toArray();

        $students_passing_quiz_in_last_x = Activity::query()
            ->where('log_name', 'student.question.response')
            ->where('created_at', '>', now()->sub($time))
            ->whereIn('causer_id', $students_ids)
            ->with('causer')
            ->get()
            ->pluck('causer')
            ->unique();

                        

        $students_who_submited_in_x = Activity::query()
        ->where('log_name', 'student.quiz.submit')
        ->where('created_at', '>', now()->sub($time))
        ->whereIn('causer_id', $students_ids)
        ->with('causer')
        ->get()
        ->pluck('causer')
        ->unique();

        foreach ($students_who_submited_in_x as $student) {
            $students_passing_quiz_in_last_x->push($student);
        }

        $this->students_passing_quiz_in_last_x = $students_passing_quiz_in_last_x->unique();

    }

    public function getStudentsStruggling()
    {
        // students where questions answered are mostly wrong (50% questions for now)

        $students_struggling = collect();

        foreach ($this->students as $student) {
            // if submitted quiz
            //get all questions and see if he is struggling
            $quiz_student = $this->quiz->students()->where('student_id', $student->id)->first();
            if ($quiz_student != null && $quiz_student->submitted) {
                // see does not have average score, struggling
                // TODO: DO NOT Hardcode passing score, let teacher specify it in quiz edit
                if ($quiz_student->score < 0.66) {
                    $students_struggling->push($student);
                }
            } else {
                $questions = QuizQuestion::query()
                    ->whereHas('responses', function ($query) use ($student) {
                        $query->where('student_id', $student->id);
                    })
                    ->get();
                if ($questions->isEmpty()) {
                    continue;
                } else {
                    // foreach questions ..
                    // if high percentage incorrect, struggling
                    $score = 0;
                    foreach ($questions as $question) {
                        $getCorrectness = new GatherStudentQuestionCorrectness;
                        $correct = $getCorrectness($student, $question);
                        if ($correct) $score++;
                    }

                    $score = $score / $questions->count();
                    // TODO: DO NOT Hardcode passing score, let teacher specify it in quiz edit
                    if ($score < 0.66) {
                        $students_struggling->push($student);
                    }
                }
            }
        }

        $this->students_struggling = $students_struggling;
    }

    public function getStudentsWithPerfectScore()
    {
        $this->students_with_perfect_score = QuizStudent::query()
            ->where('score', 1.00)
            ->with('student')->get()
            ->pluck('student');
    }

    public function getStudentsWithAllWrongAnswers()
    {

        $students_with_all_wrong_answers = collect();

        foreach ($this->students as $student) {
            $quiz_student = $this->quiz->students()->where('student_id', $student->id)->first();
            if ($quiz_student != null && $quiz_student->submitted) {
                if ($quiz_student->score = 0.00) {
                    $students_with_all_wrong_answers->push($student);
                }
            } else {
                $questions = QuizQuestion::query()
                    ->whereHas('responses', function ($query) use ($student) {
                        $query->where('student_id', $student->id);
                    })
                    ->get();
                if ($questions->isEmpty()) {
                    continue;
                } else {
                    // foreach questions ..
                    // if high percentage incorrect, struggling
                    $score = 0;
                    foreach ($questions as $question) {
                        $getCorrectness = new GatherStudentQuestionCorrectness;
                        $correct = $getCorrectness($student, $question);
                        if ($correct) $score++;
                    }
                    // TODO: DO NOT Hardcode passing score, let teacher specify it in quiz edit
                    if ($score == 0) {
                        $students_with_all_wrong_answers->push($student);
                    }
                }
            }
        }

        $this->students_with_all_wrong_answers = $students_with_all_wrong_answers;
    }

    public function getStudentsWhoHaventStartedQuizYet()
    {
        $this->students_who_havent_started_quiz_yet = $this->students->diff($this->quiz->students()->with('student')->get()->pluck('student'));
    }
}
