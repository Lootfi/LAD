<?php

namespace App\Http\Livewire\Teacher\Quiz;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Table extends DataTableComponent
{
    // protected $model = Quiz::class;

    public function builder(): Builder
    {
        return Quiz::query()
            ->where('course_id', auth()->user()->teaches->id)
            ->with(['course.students', 'course.teacher']);
    }


    public function configure(): void
    {
        $this
            ->setPrimaryKey('id')
            ->setSingleSortingDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->hideIf(true),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Course id", "course_id")
                ->hideIf(true),
            Column::make("Start date", "start_date")
                ->hideIf(true),
            Column::make("Start date")
                ->label(function (Quiz $quiz) {
                    $start_date = Carbon::parse($quiz->start_date);

                    return $start_date->format('d/m/Y');
                })
                ->searchable()
                ->sortable(),
            Column::make("Status")
                ->label(function (Quiz $quiz) {
                    $start_date = Carbon::parse($quiz->start_date);
                    return Str::ucfirst($quiz->status) . ' (' . $start_date->diffForHumans() . ')';
                }),
            Column::make("Duration", "duration")
                ->sortable(),
            Column::make('Students')
                ->label(function (Quiz $row) {
                    return view('livewire.teacher.quiz.partials.students')->withRow($row);
                }),
            Column::make('Actions')
                ->label(function (Quiz $row) {
                    return view('livewire.teacher.quiz.partials.actions')->withRow($row);
                }),
        ];
    }
}
