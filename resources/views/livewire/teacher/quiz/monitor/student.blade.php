<div class="card">
    <div class="card-body">
        <h4 class="card-title"><a href="{{ route('teacher.quiz.monitor.student', [
            'course' => $quiz->course,
            'quiz' => $quiz,
            'student' => $student
        ]) }}">{{$student->name}}</a></h4>
        <h6 class="card-subtitle text-muted">{{$student->isOnline() ?? ' online'}}</h6>
    </div>
    <div class="card-body">
        <p class="card-text">Questions</p>
        <div class="row row-cols-1 row-cols-md-3">
            @foreach ($quiz->questions as $index => $question)
            <livewire:teacher.quiz.monitor.question :student="$student" :question="$question"
                :selectedQuestion="$selectedQuestion" :wire:key="$loop->index" />
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        Actions
    </div>
</div>