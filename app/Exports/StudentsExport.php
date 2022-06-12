<?php

namespace App\Exports;

use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizStudent;
use App\Models\User;
use KcFacade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use QuizFacade;

class StudentsExport implements FromCollection, WithHeadings
{
    public Course $course;
    public $students;
    public $quizzes;
    public $kcs;

    public function __construct(Course $course, $students)
    {
        $this->course = $course;
        $this->students = $students;
        $this->quizzes = $this->course->quizzes->where('status', 'closed');
        $this->kcs = $this->course->kcs;
    }

    public function collection()
    {
        $students = User::whereIn('id', $this->students)->get(['id', 'name', 'email', 'last_seen']);

        foreach ($this->quizzes as $quiz) {
            // not a problem since we are only looping through closed quizzes
            $this->createLeftOversIfQuizIsOver($quiz);

            foreach ($students as $student) {
                $qs = QuizStudent::query()
                    ->where('student_id', $student->id)
                    ->where('quiz_id', $quiz->id)
                    ->first();

                $student['quiz_' . $quiz->id . '_score'] = $qs->score;
            }
        }

        foreach ($this->kcs as $kc) {
            foreach ($students as $student) {
                $awareness = KcFacade::getStudentRating($kc, $student);

                $student['kc: ' . '"' . $kc->name . '" awareness'] = $awareness == 'UNDETERMINED' ? $awareness : $awareness . '%';
            }
        }

        return $students;
    }

    public function headings(): array
    {
        $headings = [
            '#',
            'Name',
            'Email',
            'Last Seen',
        ];

        foreach ($this->quizzes as $quiz) {
            array_push($headings, $quiz->name . ' scores');
        }

        foreach ($this->kcs as $kc) {
            array_push($headings, '"' . $kc->name . '" awareness');
        }


        return $headings;
    }

    public function createLeftOversIfQuizIsOver(Quiz $quiz)
    {
        if (
            ($quiz->status == "closed")
            &&
            ($quiz->students->count() < $quiz->course->students()->count())
        ) {
            QuizFacade::createLeftOverStudents($quiz);
        }
    }
}
