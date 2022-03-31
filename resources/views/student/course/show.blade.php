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
@endsection