@extends('adminlte::page')

@section('title', 'Student Kc Awareness')

@section('content')
<livewire:teacher.quiz.monitor.student.index :student="$student" :quiz="$quiz" />
@endsection