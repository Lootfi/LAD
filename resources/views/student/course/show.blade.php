@extends('adminlte::page')

@section('title', $course->title)

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('student.course.index') }}">Courses</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            {{-- fa icon for message --}}
            <span class="info-box-icon bg-green" data-toggle="tooltip" data-placement="top"
                title="Chat with Mr. {{ $course->teacher->name }}"><a href=""><i class="fa fa-envelope"></i></a></span>
            <div class="info-box-content">
                <span class="info-box-text">Teacher</span>
                <span class="info-box-number">{{ $course->teacher->name }}</span>
            </div>
        </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><a href="{{ route('student.quiz.index', ['course' => $course]) }}"><i
                        class="fa fa-question"></i></a></span>
            <div class="info-box-content">
                <span class="info-box-text">Quizzes</span>
                <span class="info-box-number">{{ count($course->quizzes) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    {{-- accordion of course sections --}}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Course Sections</h3>
            </div>
            <div class="box-body">
                <div class="accordion" id="accordionExample">
                    @foreach ($course->sections as $section)
                    <div class="card">
                        <div class="card-header" id="heading{{ $section->id }}">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse{{ $section->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $section->id }}">
                                    {{ $section->name }}
                                </button>
                            </h2>
                        </div>
                        <div id="collapse{{ $section->id }}" class="collapse"
                            aria-labelledby="heading{{ $section->id }}" data-parent="#accordionExample">
                            <div class="card-body">
                                <b>Description: </b> {{ $section->description }}
                                {{-- lessons --}}
                                <br>
                                <b>Lessons: </b>
                                <br>
                                <div class="row">
                                    @foreach ($section->lessons as $lesson)
                                    <div class="col-md-3">
                                        <a href="{{ route('student.course.section.lesson.show', ['course' => $course, 'section' => $section, 'lesson' => $lesson]) }}"
                                            class="info-box">
                                            <span data-toggle="tooltip" data-placement="bottom"
                                                title="{{$lesson->description}}" class="info-box-icon bg-aqua"><i
                                                    class="fa fa-file"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $lesson->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Course Feedback</h3>
            </div>
            <div class="box-body">
                @comments(['model' => $course, 'canComment' => true])
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection