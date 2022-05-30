<div class="col-auto card mr-2 mt-1 px-0" style="width: 360px;">
    <div class="card-body student_info">
        <img class="student_avatar" src="{{$student->avatar}}" alt="">
        <h4 class="card-title"><a href="{{ route('teacher.quiz.monitor.student', [
            'course' => $quiz->course,
            'quiz' => $quiz,
            'student' => $student
        ]) }}">
                @if ($student->isOnline())
                <i class="fa fa-xs fa-circle text-success" aria-hidden="true"></i>
                @endif {{$student->name}}</a></h4>
        <br>
        @if (isset($quiz_student) && $quiz_student->submitted)
        <h6 class="text-muted mb-2"><i class="fa fa-xs fa-check" aria-hidden="true"></i> Submitted in
            {{Carbon\Carbon::make($quiz_student->submitted_at)->diffInMinutes($quiz_student->created_at)}} mins</h6>
        @endif
    </div>
    <div class="card-body">
        <p class="card-text">Questions</p>
        <div class="d-flex flex-wrap">
            @foreach ($quiz->questions as $index => $question)
            <livewire:teacher.quiz.monitor.question :student="$student" :question="$question"
                wire:key="student-{{$student->id}}-question-{{$question->id}}" />
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted">
        <livewire:teacher.quiz.monitor.student.kcs :student="$student" :quiz="$quiz"
            wire:key="student-kcs-{{$student->id}}" />
    </div>
</div>

@once
@push('css')
<style>
    .student_info {
        position: relative;
    }

    .student_avatar {
        position: absolute;
        right: 0;
        top: 0;
        width: 4rem;
    }
</style>
@endpush
@endonce