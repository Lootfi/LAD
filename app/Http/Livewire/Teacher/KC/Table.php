<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Kc;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Table extends DataTableComponent
{
    // listeners
    protected $listeners = [
        'kcCreated' => '$refresh',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        return Kc::query()
            ->where('course_id', auth()->user()->teaches->id);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->hideIf(true),
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Course id', 'course_id')
                ->hideIf(true),
            Column::make('Lessons')
                ->label(function (Kc $kc) {
                    return $kc->lessons->count();
                }),
            Column::make('Questions')
                ->label(function (Kc $kc) {
                    return $kc->questions->count();
                }),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->hideIf(true),
            Column::make('Actions')
                ->label(function (Kc $row) {
                    return view('livewire.teacher.kc.partials.actions')->withRow($row);
                }),
        ];
    }
}
