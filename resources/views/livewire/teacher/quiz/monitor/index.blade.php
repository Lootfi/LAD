<div>
    {{-- bootstrap column card groups --}}
    <div class="card-columns">
        @foreach ($course->students as $student)
        <livewire:teacher.quiz.monitor.student :quiz="$quiz" :student="$student" />
        @endforeach
    </div>
</div>