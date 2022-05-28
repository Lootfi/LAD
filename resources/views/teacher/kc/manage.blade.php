@extends('adminlte::page')

@section('title', 'Manage Course KCs')

@section('content_header')
<li class="breadcrumb-item"><a href="{{ route('teacher.course.show', $course) }}">{{$course->name}}</a></li>
<li class="breadcrumb-item active">Manage KCs</li>
@endsection

@section('content')
<div class="container-fluid mt--7">

    <h4 class="text-uppercase ls-1 mb-4">Add KC to Course</h4>

    <div class="row w-100">
        {{-- create new KC --}}
        <livewire:teacher.kc.create :course="$course" />
    </div>
    <hr>
    <h4 class="text-uppercase ls-1 mb-4 mt-5">Course KCs</h4>
    <div class="row w-100">
        {{-- header of row : Course KCs--}}
        <livewire:teacher.kc.table :course="$course" />
    </div>
    <hr>
    <h4 class="text-uppercase ls-1 mb-4 mt-5">Splittable KCs</h4>
    <div class="row w-100">
        <livewire:teacher.kc.fetch-splittable :course="$course" />
    </div>
</div>
@endsection