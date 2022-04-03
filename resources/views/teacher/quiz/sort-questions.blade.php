@extends('adminlte::page')

@section('title', 'Sort Quiz Questions')

@section('content_header')
{{-- breadcrumb items --}}
<li class="breadcrumb-item">
    <a href="{{ route('teacher.course.show', ['course' => $quiz->course]) }}">{{$quiz->course->title}}</a>
</li>
<li class="breadcrumb-item">
    <a href="{{ route('teacher.quiz.index', ['course' => $quiz->course]) }}">Quizzes</a>
</li>
<li class="breadcrumb-item active">{{$quiz->name}}</li>
@endsection

@section('content')
@livewire('teacher.quiz.sort-questions', ['quiz' => $quiz], key($quiz->id))
@endsection