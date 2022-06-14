<?php

namespace App\Http\Livewire\Teacher\Course\Cards;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class LessonVisits extends Component
{
    public $course;

    public $lessons_visits;

    protected $listeners = [
        'echo:student-activity,Student\ViewLesson' => 'addLessonView',
    ];

    public function mount()
    {
        $this->course = auth()->user()->teaches;

        $this->setLessonsVisits($this->course->lessons);
    }

    public function render()
    {
        return view('livewire.teacher.course.cards.lesson-visits');
    }

    public function setLessonsVisits($lessons)
    {
        $visits = [];

        foreach ($lessons as $lesson) {
            $activitiesBuilder = Activity::query()
                ->where('subject_type', 'App\Models\Lesson')
                ->whereSubjectId($lesson->id);
            $activities = $activitiesBuilder->get();

            $percentage = $this->getPercentageChangeSinceLastWeek($activitiesBuilder);

            $visits[$lesson->id] = [
                'name' => $lesson->name,
                'section_id' => $lesson->section_id,
                'visits' => $activities->count(),
                'unique_students' => $activities->groupBy('causer_id')->count(),
                'since_last_week' => $percentage,
                'students' => [],
            ];

            $visits[$lesson->id] = $this->setLessonViewers($visits[$lesson->id], $activities->unique('causer_id'));
        }

        $this->lessons_visits = $visits;
    }

    public function addLessonView(array $params)
    {
        $lesson = Lesson::find($params['lesson']['id']);
        $student = User::find($params['student']['id']);

        $lesson_visits = $this->lessons_visits[$lesson->id];

        $lesson_visits['visits']++;

        $lesson_visits['since_last_week'] = $this->getPercentageChangeSinceLastWeek(Activity::query()
            ->where('subject_type', 'App\Models\Lesson')
            ->whereSubjectId($lesson->id));

        if (! array_key_exists($student->id, $lesson_visits['students'])) {
            $lesson_visits['unique_students']++;
            $lesson_visits['students'][$student->id]['name'] = $student->name;
            $lesson_visits['students'][$student->id]['avatar'] = $student->avatar;
        }

        $this->lessons_visits[$lesson->id] = $lesson_visits;
    }

    public function setLessonViewers($lesson_visits, $activities)
    {
        foreach ($activities as $activity) {
            $lesson_visits['students'][$activity->causer_id] = [
                'name' => $activity->causer->name,
                'avatar' => $activity->causer->avatar,
            ];
        }

        return $lesson_visits;
    }

    public function getPercentageChangeSinceLastWeek(Builder $activitiesBuilder)
    {
        $lastTwoWeeksActivities = $activitiesBuilder
            ->where('created_at', '>=', now()->subWeeks(2))
            ->count();
        $lastWeekActivities = $activitiesBuilder
            ->where('created_at', '>=', now()->subWeeks(1))
            ->count();

        if (($lastTwoWeeksActivities == 0 && $lastWeekActivities == 0)) {
            return 0;
        } elseif (($lastTwoWeeksActivities - $lastWeekActivities) == 0) {
            return 100;
        } else {
            return round(($lastWeekActivities * 100 / ($lastTwoWeeksActivities - $lastWeekActivities)) - 100, 1);
        }
    }
}
