<?php

namespace App\Http\Livewire\Teacher\Kc;

use App\Models\Kc;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\QuizQuestion;
use Illuminate\Database\Eloquent\Builder;

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
            ->when(
                $this->questionids ?? null,
                fn ($q) => $q->whereIn('id', $this->questionids),
            );;
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Question", "question")
                ->sortable(),
            Column::make("Quiz id", "quiz_id")
                ->sortable(),
            Column::make("Order", "order")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
