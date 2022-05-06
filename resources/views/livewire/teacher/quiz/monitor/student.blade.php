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
                :wire:key="$loop->index" />
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        <livewire:teacher.quiz.monitor.student.kcs :student="$student" :quiz="$quiz" />
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-bell"></i>
                        Notify
                    </button>

                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-envelope"></i>
                        Message
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>