@extends('adminlte::page')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item">Import Students</li>
@endsection
@section('content')
<livewire:teacher.course.import-students :course="$course" />
@endsection