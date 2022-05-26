@extends('adminlte::page')

@section('title', 'Message Student')

@section('content_header')
<a href="{{ route('teacher.quiz.index', ['course' => $course]) }}" class="breadcrumb-item">Quizzes</a>
<a href="{{ route('teacher.quiz.show', ['course' => $course, 'quiz' => $quiz]) }}"
    class="breadcrumb-item">{{$quiz->name}}</a>
<p class="breadcrumb-item">Monitor</p>

@endsection

@section('content')
<livewire:teacher.quiz.monitor.student.message :quiz="$quiz" :student="$student" />
@endsection