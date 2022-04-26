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
        {{-- <a href="#" class="card-link">Link 1</a>
        <a href="#" class="card-link">Link 2</a> --}}
        <div class="card-columns">
            @foreach ($quiz->questions as $index => $question)
            {{-- question card, only takes q-index (int), q-answered (boolean), q-right (boolean) --}}
            <livewire:teacher.quiz.monitor.question :student="$student" :question="$question" />
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        Actions
    </div>
</div>