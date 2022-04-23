<?php

namespace App\Http\Livewire\Teacher\Lesson\Cards\Graphs;

use App\Models\Lesson;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use Livewire\Component;

class StudentsActivity extends Component
{

    public $lesson;
    public $studentsActivity;
    public $time = '1 month';

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $activities = $this->getNewActivities();
        $this->studentsActivity = $activities;
    }

    public function render()
    {
        return view('livewire.teacher.lesson.cards.graphs.students-activity');
    }

    public function updateStudentsActivity()
    {
        $newActivity = $this->getNewActivities();
        // compare two collections
        $diff = $newActivity->diff($this->studentsActivity);
        if ($diff->isEmpty()) {
            return;
        } else {
            $this->studentsActivity = $newActivity;
            $this->emit('addLessonVisitData', $diff);
        }
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

        return $activities;
    }

    public function updateTime($time)
    {
        $this->time = $time;
        $this->studentsActivity = $this->getNewActivities();
        $this->emit('updateLessonViewTime', $this->studentsActivity);
    }
}
