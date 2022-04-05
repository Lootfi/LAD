<?php

namespace App\Http\Livewire\Teacher\Quiz;

use App\Models\Course;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Table extends DataTableComponent
{
    // protected $model = Quiz::class;

    public Course $course;

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function builder(): Builder
    {
        return Quiz::query()
            ->where('course_id', auth()->user()->teaches->id)
            ->with(['course.students', 'course.teacher']);
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Course id", "course_id")
                ->sortable(),
            Column::make("Start date", "start_date")
                ->sortable(),
            Column::make("Duration", "duration")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
