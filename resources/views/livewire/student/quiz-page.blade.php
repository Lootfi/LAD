<div>
    @if($quiz->is_active)

    <div>
        <livewire:student.quiz-component :quiz="$quiz" />
    </div>

    {{-- else --}}
    @else

    <hr>
    <h1>livewire part</h1>
    <livewire:student.quiz-countdown-timer :quiz="$quiz" />
    <hr>


    <h1>Not yet</h1>

    {{-- show time left --}}
    {{-- time left is a countdown --}}
    <p>Time left: {{Carbon\Carbon::parse($quiz->start_date)->diffForHumans(['parts' => 6])}}</p>
    <p>Start Date: {{$quiz->start_date}}</p>
    <p>Now: {{now()}}</p>
    @endif
</div>