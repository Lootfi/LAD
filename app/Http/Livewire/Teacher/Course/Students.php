<?php

namespace App\Http\Livewire\Teacher\Course;

use App\Exports\StudentsExport;
use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

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
            Column::make('Id', 'id')
                ->hideIf(true),
            ImageColumn::make('Avatar')
                ->location(
                    fn ($row) => $row->avatar
                )
                ->collapseOnMobile(),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Created at', 'created_at')
                ->hideIf(true),
            Column::make('Updated at', 'updated_at')
                ->hideIf(true),
            Column::make('Last Seen')
            ->format(
                function ($value, $row, Column $column) {
                    $last_seen = Carbon::make($row->last_seen);
                    if ($last_seen) {
                        return $last_seen->diffForHumans();
                    } else {
                        return '';
                    }
                }
            ),
        ];
    }

    public function export()
    {
        $students = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new StudentsExport($this->course, $students), 'my_students.xlsx');
    }
}
