@extends('adminlte::page')

@section('title', 'Course Quizzes')

@section('content_header')
<a href="{{ route('student.course.show', ['course' => $course]) }}" class="breadcrumb-item">Course</a>
<p class="breadcrumb-item">Quizzes</p>
@endsection

@section('content')

<livewire:teacher.quiz.table :course="$course" />

@endsection