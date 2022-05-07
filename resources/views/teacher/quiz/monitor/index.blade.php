@extends('adminlte::page')

@section('title', 'Monitor Quiz')

@section('content_header')
<a href="{{ route('teacher.quiz.index', ['course' => $course]) }}" class="breadcrumb-item">Quizzes</a>
<a href="{{ route('teacher.quiz.show', ['course' => $course, 'quiz' => $quiz]) }}"
    class="breadcrumb-item">{{$quiz->name}}</a>
<p class="breadcrumb-item">Monitor</p>

@endsection

@section('content')
<div class="">

    {{--
    <livewire:teacher.quiz.monitor.index-actions :quiz="$quiz" /> --}}
    <div class="row">
        <livewire:teacher.quiz.monitor.index :course="$course" :quiz="$quiz" />
    </div>

    <hr>

    <div class="row">
        <div class="col col-md-6 col-sm-12 mt-3">
            <livewire:teacher.quiz.monitor.graphs.index.questions-error-rate :quiz="$quiz" />
        </div>
        <div class="col col-md-6 col-sm-12 mt-3">
            <livewire:teacher.quiz.monitor.graphs.index.kc-error-rate :quiz="$quiz" />
        </div>
    </div>

</div>

@endsection