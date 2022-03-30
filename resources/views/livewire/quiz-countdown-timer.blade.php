<div wire:poll.5000ms>
    {{-- update start_date every second by livewire polling--}}
    <p>Time left: {{Carbon\Carbon::parse($quiz->start_date)->diffForHumans(['parts' => 6])}}</p>
</div>