<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Kc;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Questions extends DataTableComponent
{
    public $kc;

    public $questionids;

    // listeners
    protected $listeners = [
        'kcCreated' => '$refresh',
    ];

    public function mount(Kc $kc, $questionids)
    {
        $this->kc = $kc;
        $this->questionids = $questionids;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc');
    }

    public function builder(): Builder
    {
        return QuizQuestion::query()
            ->whereIn('id', $this->questionids);
    }

    public function columns(): array
    {
        return [
            Column::make('Quiz', 'quiz_id'),
            Column::make('Q#', 'order'),
            Column::make('Question', 'question')
                ->sortable(),
            Column::make('Order', 'order')
                ->hideIf(true),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->hideIf(true),
            Column::make('Actions')
                ->label(function (QuizQuestion $row) {
                    return view('teacher.kc.partials.question-actions')->withRow($row);
                }),
        ];
    }
}
