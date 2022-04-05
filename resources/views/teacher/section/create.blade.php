@extends('adminlte::page')

@section('title', 'Course')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.course.show', [$course]) }}">{{$course->title }} Course</a></li>
<li class="breadcrumb-item active">Add Section</li>
@endsection

@section('content')
@endsection