<div>
    @if($quiz->is_active)
    <livewire:student.quiz-component :quiz="$quiz" />
    @else
    <h1>Not ready</h1>
    <livewire:student.quiz-countdown-timer :quiz="$quiz" />
    @endif
</div>