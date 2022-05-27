@extends('adminlte::page')

@section('title', 'Import Students')

@section('content_header')
<li class="breadcrumb-item">Import Students</li>
@endsection

@section('content')
<livewire:teacher.course.import-students :course="$course" />
@endsection