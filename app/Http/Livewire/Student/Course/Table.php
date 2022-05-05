<?php

namespace App\Http\Livewire\Student\Course;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class Table extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Course::whereHas('students', function ($query) {
            $query->where('id', auth()->id());
        });
    }

    public function columns(): array
    {
        return [
            Column::make("My Courses")
                ->label(
                    fn ($row, Column $column) => '<a href="/student/course/' . $row->id . '">' . $row->title . '</a>'
                )
                ->html(),
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Title", "title")
                ->hideIf(true),
            Column::make("Active", "active")
                ->hideif(true),
            Column::make("Teacher id", "teacher_id")
                ->hideif(true),
            Column::make("Created at", "created_at")
                ->hideif(true),
            Column::make("Updated at", "updated_at")
                ->hideif(true),
        ];
    }
}
