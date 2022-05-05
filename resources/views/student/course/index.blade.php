@extends('adminlte::page')

@section('title', 'My Courses')


@section('content_header')
<li class="breadcrumb-item active">Courses</li>
@endsection

@section('content')
<livewire:student.course.table />

@endsection