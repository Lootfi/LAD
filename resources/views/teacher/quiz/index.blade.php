@extends('adminlte::page')

@section('title', 'Course Quizzes')

@section('content_header')
<p class="breadcrumb-item">Quizzes</p>
@endsection

@section('content')

<livewire:teacher.quiz.table :course="$course" />

@endsection