@extends('adminlte::page')

@section('title', 'Manage Students')

@section('content_header')
<li class="breadcrumb-item">Manage Students</li>
@endsection

@section('content')
<livewire:teacher.course.students :course="$course" />
@endsection