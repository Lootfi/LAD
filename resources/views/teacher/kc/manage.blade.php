@extends('adminlte::page')

@section('title', 'Manage Course KCs')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.course.show', $course) }}">{{$course->name}}</a></li>
<li class="breadcrumb-item active">Manage KCs</li>
@endsection

@section('content')
<div class="container-fluid mt--7">

    <div class="row">
        {{-- create new KC --}}
        <livewire:teacher.kc.create :course="$course" />
    </div>
    <div class="row">
        <livewire:teacher.kc.table :course="$course" />
    </div>
</div>
@endsection