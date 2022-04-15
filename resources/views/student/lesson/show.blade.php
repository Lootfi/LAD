@extends('adminlte::page')

@section('title', 'Course Lesson: ' . $lesson->name)

{{-- content_header --}}
@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('student.course.index') }}">Courses</a></li>
<li class="breadcrumb-item"><a href="{{ route('student.course.show', ['course' => $course]) }}">{{ $course->title }}</a>
</li>
{{-- sections index --}}
<li class="breadcrumb-item"><a href="{{ route('student.course.section.index', ['course' => $course]) }}">Sections</a>
</li>
{{-- section --}}
<li class="breadcrumb-item"><a
        href="{{ route('student.course.section.show', ['course' => $course, 'section' => $section]) }}">{{
        $section->name }}</a>
</li>
{{-- lesson --}}
<li class="breadcrumb-item active" aria-current="page">{{ $lesson->name }}</li>
@endsection

{{-- content --}}
@section('content')
{{-- Course Info header --}}
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
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><a href="#"><i class="fa fa-list"></i></a></span>
            <div class="info-box-content">
                <span class="info-box-text">Sections</span>
                <span class="info-box-number">{{ count($course->sections) }}</span>
            </div>
        </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><a href="#"><i class="fa fa-book"></i></a></span>
            <div class="info-box-content">
                <span class="info-box-text">Lessons</span>
                <span class="info-box-number">{{ count($section->lessons) }}</span>
            </div>
        </div>
    </div>

</div>
{{-- /Course Info header --}}
<br>
<hr>
<br>

{{-- Lesson --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $lesson->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! $lesson->content !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- /Lesson --}}
@endsection