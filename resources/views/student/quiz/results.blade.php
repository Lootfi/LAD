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
            <h5 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapse-{{$question->id}}" aria-expanded="true"
                    aria-controls="collapse-{{$question->id}}">
                    #Question {{$key+1}}: {{ $question->question }}
                    @if ($correct[$question->id])
                    <i class="fas fa-lg fa-check text-success"></i>
                    </span>
                    @else
                    <i class="fas fa-lg fa-times text-danger"></i>
                    @endif
                </button>
            </h5>
        </div>

        <div id="collapse-{{$question->id}}" class="collapse {{$key == 0 ? 'show': ''}}"
            aria-labelledby="heading-{{$question->id}}" data-parent="#QuestionsAccordion">
            <div class="card-body">
                {{-- shot student his answers --}}
                @foreach ($question->answers as $answer)
                <div
                    class="row {{$answer->right_answer ? 'bg-success text-white':''}}
                {{($answer->right_answer == false && $responses[$question->id][$answer->id]['answered']) ? 'bg-danger text-white':'' }}">
                    <div class="col-md-1">
                        <input type="checkbox" disabled {{$responses[$question->id][$answer->id]['answered'] ? 'checked'
                        : '' }}>
                    </div>
                    <div class="col-md-11">
                        {{ $answer->answer }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection