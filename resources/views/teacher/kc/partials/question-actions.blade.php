@php
$question = App\Models\QuizQuestion::where('quiz_id',$row->quiz_id)->first();
$quiz = $question->quiz;
$course = App\Models\Course::where('id',$quiz->course_id)->first();
$question_id = $row->id;
@endphp

<div class="row">
    <div class="col-auto">
        <a href="{{ route('teacher.quiz.edit', ['course' => $course, 'quiz' => $quiz, 'question_id' => $question_id]) }}"
            class="btn btn-sm btn-icon btn-2 btn-primary btn-text-secondary">
            <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
        </a>
    </div>
</div>