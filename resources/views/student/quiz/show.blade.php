@extends('adminlte::page', ['no_navigation' => true])

@section('title', $quiz->name)

@section('css')
<style>
    .content-wrapper {
        margin: 0 2em !important;
        padding: 0 2em !important;
    }
</style>
@endsection

@section('content_header')
<a href="{{ route('student.quiz.index', ['course' => $quiz->course]) }}" class="breadcrumb-item">Quizzes</a>
<p class="breadcrumb-item">{{$quiz->name}}</p>
@stop

@section('content')

<livewire:student.quiz-page :quiz="$quiz" />

@endsection