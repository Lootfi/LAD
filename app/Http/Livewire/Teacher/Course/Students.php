<?php

namespace App\Http\Livewire\Teacher\Course;

use App\Exports\StudentsExport;
use App\Models\Course;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Maatwebsite\Excel\Facades\Excel;

class Students extends DataTableComponent
{
    public Course $course;

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function builder(): Builder
    {
        return $this->course->students()->getQuery();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            ImageColumn::make('Avatar')
                ->location(
                    fn($row) => $row->avatar
                ),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function export()
    {
        $students = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new StudentsExport($students), 'my_students.xlsx');
    }
}
