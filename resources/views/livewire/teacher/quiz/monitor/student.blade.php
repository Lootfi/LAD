<div class="col-auto card mr-2 mt-1 px-0" style="width: 360px;">
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
        <div class="card-columns">
            @foreach ($quiz->questions as $index => $question)
            <livewire:teacher.quiz.monitor.question :student="$student" :question="$question"
                :wire:key="$loop->index" />
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        <livewire:teacher.quiz.monitor.student.kcs :student="$student" :quiz="$quiz" />
    </div>
</div>