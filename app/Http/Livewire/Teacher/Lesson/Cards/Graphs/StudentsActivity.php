<?php

namespace App\Http\Livewire\Teacher\Lesson\Cards\Graphs;

use App\Models\Lesson;
use App\Models\User;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class StudentsActivity extends Component
{
    public $lesson;

    public $studentsActivity;

    public $time = '1 month';

    protected $listeners = [
        'echo:student-activity,Student\ViewLesson' => 'updateStudentsActivity',
    ];

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->getNewActivities();
    }

    public function render()
    {
        return view('livewire.teacher.lesson.cards.graphs.students-activity');
    }

    public function updateStudentsActivity(array $params = null)
    {
        $this->getNewActivities();
    }

    public function getNewActivities()
    {
        $activities = Activity::select(['causer_id'])
            ->where('subject_type', 'App\Models\Lesson')
            ->whereSubjectId($this->lesson->id)
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

        if ($this->studentsActivity == null) {
            $this->studentsActivity = $activities;
            $this->emit('addLessonVisitData', $this->studentsActivity);

            return;
        }

        $diff = $activities->diff($this->studentsActivity);
        if (! $diff->isEmpty()) {
            $this->studentsActivity = $activities;
            $this->emit('addLessonVisitData', $diff);
        }
    }

    public function updateTime($time)
    {
        $this->time = $time;
        $this->getNewActivities();
        $this->emit('updateLessonViewTime', $this->studentsActivity);
    }
}
