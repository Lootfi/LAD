@extends('adminlte::page')

@section('content')
<livewire:teacher.quiz.monitor.student.index :student="$student" :quiz="$quiz" />
@endsection