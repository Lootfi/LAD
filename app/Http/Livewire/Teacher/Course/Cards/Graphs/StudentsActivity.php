<?php

namespace App\Http\Livewire\Teacher\Course\Cards\Graphs;

use App\Models\User;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class StudentsActivity extends Component
{
    public $course;
    public $studentsActivity = null;
    public $time = '1 month';
    public $studentsLessonViews = null;

    protected $listeners = [
        'echo:student-activity,Student\ViewCourse' => 'updateStudentsActivity'
    ];

    public function mount()
    {
        $this->course = auth()->user()->teaches;
        $this->getNewActivities();
        $this->getLessonViews();

        $this->emit('addCourseVisitData', $this->studentsActivity, $this->studentsLessonViews);
    }

    public function render()
    {
        return view('livewire.teacher.course.cards.graphs.students-activity');
    }

    public function updateStudentsActivity()
    {
        $this->getNewActivities();
    }

    public function getNewActivities()
    {
        $activities = Activity::select(['causer_id'])
            ->where('subject_type', 'App\Models\Course')
            ->whereSubjectId($this->course->id)
            ->where('created_at', '>=', now()->sub($this->time))
            ->get()
            ->groupBy('causer_id')
            ->map(function ($item) {
                return $item->count();
            });
        foreach ($activities as $student_id => $actnum) {
            $activities[User::where('id', $student_id)->first()->name] = $actnum;
            unset($activities[$student_id]);
        }

        $this->studentsActivity = $activities;
    }

    public function getLessonViews()
    {

        $activities = Activity::select(['causer_id'])
            ->where('subject_type', 'App\Models\Lesson')
            ->whereIn('subject_id', $this->course->lessons->pluck(['id'])->toArray())
            ->where('created_at', '>=', now()->sub($this->time))
            ->get()
            ->groupBy('causer_id')
            ->map(function ($item) {
                return $item->count();
            });

        foreach ($activities as $student_id => $actnum) {
            $activities[User::where('id', $student_id)->first()->name] = $actnum;
            unset($activities[$student_id]);
        }

        $this->studentsLessonViews = $activities;
    }

    public function updateTime($time)
    {
        $this->time = $time;
        $this->getNewActivities();
        $this->getLessonViews();
        $this->emit('updateCourseViewTime', $this->studentsActivity, $this->studentsLessonViews);
    }
}
