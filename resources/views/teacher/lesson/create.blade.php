@extends('adminlte::page')

@section('title', 'Create Lesson')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.course.show', ['course' => $course]) }}">Course</a>
</li>
<li class="breadcrumb-item"><a href="{{ route('teacher.course.section.index', ['course' =>  $course]) }}">Sections</a>
</li>
<li class="breadcrumb-item"><a
        href="{{ route('teacher.course.section.show', ['course' =>  $course, 'section' => $section]) }}">{{$section->name}}</a>
</li>
<li class="breadcrumb-item active">Create Lesson</li>
@endsection

@section('content')

@endsection