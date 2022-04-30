@extends('adminlte::page')

@section('title', 'Monitor Quiz')

@section('content_header')
<a href="{{ route('teacher.course.show', ['course' => $course]) }}" class="breadcrumb-item">Course</a>
<a href="{{ route('teacher.quiz.index', ['course' => $course]) }}" class="breadcrumb-item">Quizzes</a>
<a href="{{ route('teacher.quiz.show', ['course' => $course, 'quiz' => $quiz]) }}" class="breadcrumb-item">Quiz</a>
<p class="breadcrumb-item">Monitor</p>

@endsection

@section('content')

<livewire:teacher.quiz.monitor.index :course="$course" :quiz="$quiz" />

<hr>
<hr>
<hr>

<livewire:teacher.quiz.monitor.graphs.one :quiz="$quiz" />

@endsection