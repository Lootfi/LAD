<?php

namespace App\Http\Livewire\Teacher\KC;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\QuizQuestion;

class Questions extends DataTableComponent
{
    protected $model = QuizQuestion::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
