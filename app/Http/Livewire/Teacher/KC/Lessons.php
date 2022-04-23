<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Kc;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;

class Lessons extends DataTableComponent
{
    public $kc;
    public $lessonids;

    // listeners
    protected $listeners = [
        'kcCreated' => '$refresh',
    ];

    public function mount(Kc $kc, $lessonids)
    {
        $this->kc = $kc;
        $this->lessonids = $lessonids;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        return Lesson::query()
            ->when(
                $this->lessonids ?? null,
                fn ($q) => $q->whereIn('id', $this->lessonids),
            );;
    }



    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Lesson Name", "name")
                ->sortable(),
            Column::make("Status", "status")
                ->hideIf(true),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->hideIf(true),
            Column::make("Actions")
                ->label(function (Lesson $row) {
                    return view('teacher.kc.partials.lesson-actions')->withRow($row);
                })
        ];
    }
}
