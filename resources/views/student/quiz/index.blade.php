@extends('adminlte::page')

@section('title', $course->title . ' | Quizzes')

@section('content_header')
<a href="{{ route('student.course.index') }}" class="breadcrumb-item">Courses</a>
<p class="breadcrumb-item">{{ $course->title }}</p>
<p class="breadcrumb-item">Quizzes</p>
@endsection

@section('content')

{{-- list of quizzes --}}
<x-student.quiz.active_quizzes :quizzes="$quizzes['active']" />
<x-student.quiz.upcoming_quizzes :quizzes="$quizzes['upcoming']" />
<x-student.quiz.closed_quizzes :quizzes="$quizzes['closed']" />

@endsection