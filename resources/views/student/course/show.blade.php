@extends('adminlte::page')

@section('title', $course->title)

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('student.course.index') }}">Courses</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
@endsection