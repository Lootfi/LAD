<?php

namespace App\Http\Livewire\Teacher\Lesson;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Lesson;
use App\Models\Section;

use function PHPSTORM_META\type;

class Table extends DataTableComponent
{
    public Section $section;


    public function builder(): Builder
    {
        return Lesson::query()
            ->where('section_id', $this->section->id)
            ->with(['section.course']);
    }

    // mount method, gets section
    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [

            Column::make("Id", "id")
                ->hideIf(true),
            // section_id
            Column::make("Section id", "section_id")->hideIf(true),
            Column::make("Name", "name"),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
            Column::make('Actions')
                ->label(function (Lesson $row) {
                    return view('livewire.teacher.lesson.partials.actions')->withRow($row);
                }),

        ];
    }
}
