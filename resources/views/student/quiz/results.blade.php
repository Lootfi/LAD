@extends('adminlte::page')
{{-- quiz results page --}}

@section('title', 'Course Quiz - Results')


@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('student.course.index') }}">Courses</a></li>
<li class="breadcrumb-item"><a href="{{ route('student.course.show', $quiz->course->id) }}">{{ $quiz->course->title
        }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('student.quiz.index', $quiz->course) }}">Quizzes</a></li>
<li class="breadcrumb-item"><a href="{{ route('student.quiz.show', [$quiz->course, $quiz]) }}">{{$quiz->name}}</a></li>
<li class="breadcrumb-item active">Results</li>
@endsection

@section('content')
<div class="accordion" id="QuestionsAccordion">
    @foreach ($quiz->questions as $key => $question)

    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between" type="button"
                    data-toggle="collapse" data-target="#collapse-{{$question->id}}" aria-expanded="true"
                    aria-controls="collapse-{{$question->id}}">
                    <p>#Question {{$key+1}}: {{ $question->question }}</p>
                    <p>{{var_export($question->correct)}}</p>
                </button>
            </h2>
        </div>

        <div id="collapse-{{$question->id}}" class="collapse {{$key == 0 ? 'show': ''}}"
            aria-labelledby="heading-{{$question->id}}" data-parent="#QuestionsAccordion">
            <div class="card-body">
                Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the
                <code>.show</code> class.
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection